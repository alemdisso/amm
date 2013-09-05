<?php

class Amm_Collection_EditionMapper
{

    protected $db;
    protected $identityMap;

    function __construct()
    {
        $this->db = Zend_Registry::get('db');
        $this->identityMap = new SplObjectStorage;
    }

    public function getAllIds()
    {
        $query = $this->db->prepare('SELECT id FROM collection_editions WHERE 1=1;');
        $query->execute();
        $resultPDO = $query->fetchAll();

        $result = array();
        foreach ($resultPDO as $row) {
            $result[] = $row['id'];
        }
        return $result;

    }

    public function insert(Amm_Collection_Edition $obj)
    {

        $query = $this->db->prepare("INSERT INTO collection_editions (work, editor, pages, cover_image_filename, isbn, illustrator, cover_designer)
            VALUES (:work, :editor, :pages, :cover_image_filename, :isbn, :illustrator, :cover_designer)");

        $query->bindValue(':work', $obj->getWork(), PDO::PARAM_STR);
        $query->bindValue(':editor', $obj->getEditor(), PDO::PARAM_STR);
        $query->bindValue(':pages', $obj->getPages(), PDO::PARAM_STR);
        $query->bindValue(':cover_image_filename', $obj->getCoverImageFilename(), PDO::PARAM_STR);
        $query->bindValue(':isbn', $obj->getIsbn(), PDO::PARAM_STR);
        $query->bindValue(':illustrator', $obj->getIllustrator(), PDO::PARAM_STR);
        $query->bindValue(':cover_designer', $obj->getCoverDesigner(), PDO::PARAM_STR);

        $query->execute();

        $obj->SetId((int)$this->db->lastInsertId());
        $this->identityMap[$obj] = $obj->getId();

    }

    public function update(Amm_Collection_Edition $obj)
    {
        if (!isset($this->identityMap[$obj])) {
            throw new Amm_Collection_EditionMapperException('Object has no ID, cannot update.');
        }

        $query = $this->db->prepare("UPDATE collection_editions SET work = :work, editor = :editor, pages = :pages
             , cover_image_filename = :cover_image_filename, isbn = :isbn, illustrator = :illustrator, cover_designer = :cover_designer
            WHERE id = :id;");

        $query->bindValue(':work', $obj->getWork(), PDO::PARAM_STR);
        $query->bindValue(':editor', $obj->getEditor(), PDO::PARAM_STR);
        $query->bindValue(':pages', $obj->getPages(), PDO::PARAM_STR);
        $query->bindValue(':cover_image_filename', $obj->getCoverImageFilename(), PDO::PARAM_STR);
        $query->bindValue(':isbn', $obj->getIsbn(), PDO::PARAM_STR);
        $query->bindValue(':illustrator', $obj->getIllustrator(), PDO::PARAM_STR);
        $query->bindValue(':cover_designer', $obj->getCoverDesigner(), PDO::PARAM_STR);
        $query->bindValue(':id', $obj->getId(), PDO::PARAM_STR);

        try {
            $query->execute();
        } catch (Exception $e) {
            throw new Amm_Collection_EditionException("sql failed");
        }

    }

    public function findById($id)
    {
        $this->identityMap->rewind();
        while ($this->identityMap->valid()) {
            if ($this->identityMap->getInfo() == $id) {
                return $this->identityMap->current();
            }
            $this->identityMap->next();
        }

        $query = $this->db->prepare('SELECT work, editor, pages, cover_image_filename, isbn, illustrator, cover_designer FROM collection_editions WHERE id = :id;');
        $query->bindValue(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch();
        if (empty($result)) {
            throw new Amm_Collection_EditionMapperException(sprintf('There is no edition with id #%d.', $id));
        }
        $work = $result['work'];
        $obj = new Amm_Collection_Edition();
        $this->setAttributeValue($obj, $id, 'id');
        $this->setAttributeValue($obj, $result['editor'], 'editor');
        $this->setAttributeValue($obj, $result['work'], 'work');
        $this->setAttributeValue($obj, $result['pages'], 'pages');
        $this->setAttributeValue($obj, $result['cover_image_filename'], 'cover_image_filename');
        $this->setAttributeValue($obj, $result['isbn'], 'isbn');
        $this->setAttributeValue($obj, $result['illustrator'], 'illustrator');
        $this->setAttributeValue($obj, $result['cover_designer'], 'cover_designer');

        $this->identityMap[$obj] = $id;

        return $obj;

    }

    public function findByWork($work)
    {
        $query = $this->db->prepare('SELECT id FROM collection_editions WHERE work = :work LIMIT 1;');
        $query->bindValue(':work', $work, PDO::PARAM_STR);
        $query->execute();

        $result = $query->fetch();

        if (empty($result)) {
            throw new Amm_Collection_EditionMapperException(sprintf('There is no edition with work #%s.', $work));
        }
        $id = $result['id'];

        if ($id > 0) {
            return $this->findById($id);
        } else {
            throw new Amm_Collection_EditionMapperException(sprintf('The edition with id #%s has id=0?!?.', $work));
        }
    }


    public function delete(Amm_Collection_Edition $obj)
    {
        if (!isset($this->identityMap[$obj])) {
            throw new Amm_Collection_EditionMapperException('Object has no ID, cannot delete.');
        }
        $query = $this->db->prepare('DELETE FROM collection_editions WHERE id = :id;');
        $query->bindValue(':id', $this->identityMap[$obj], PDO::PARAM_STR);
        $query->execute();
        unset($this->identityMap[$obj]);
    }


   public function getAllEditionsAlphabeticallyOrdered()
    {
        $query = $this->db->prepare('SELECT id, editor FROM collection_editions WHERE 1 =1 ORDER BY editor;');
        $query->bindValue(':project', $obj->getId(), PDO::PARAM_STR);
        $query->execute();
        $resultPDO = $query->fetchAll();

        $data = array();
        foreach ($resultPDO as $row) {
            $data[$row['id']] = $row['editor'];
        }
        return $data;

    }




    private function setAttributeValue(Amm_Collection_Edition $a, $fieldValue, $attributeEditor)
    {
        $attribute = new ReflectionProperty($a, $attributeEditor);
        $attribute->setAccessible(TRUE);
        $attribute->setValue($a, $fieldValue);
    }


}