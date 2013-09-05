<?php

class Amm_Collection_EditorMapper
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
        $query = $this->db->prepare('SELECT id FROM collection_editors WHERE 1=1;');
        $query->execute();
        $resultPDO = $query->fetchAll();

        $result = array();
        foreach ($resultPDO as $row) {
            $result[] = $row['id'];
        }
        return $result;

    }

    public function insert(Amm_Collection_Editor $obj)
    {

        $query = $this->db->prepare("INSERT INTO collection_editors (uri, name, country)
            VALUES (:uri, :name, :country)");

        $query->bindValue(':uri', $obj->GetUri(), PDO::PARAM_STR);
        $query->bindValue(':name', $obj->GetName(), PDO::PARAM_STR);
        $query->bindValue(':country', $obj->GetCountry(), PDO::PARAM_STR);

        $query->execute();

        $obj->SetId((int)$this->db->lastInsertId());
        $this->identityMap[$obj] = $obj->GetId();

    }

    public function update(Amm_Collection_Editor $obj)
    {
        if (!isset($this->identityMap[$obj])) {
            throw new Amm_Collection_EditorMapperException('Object has no ID, cannot update.');
        }

        $query = $this->db->prepare("UPDATE collection_editors SET uri = :uri, name = :name, country = :country WHERE id = :id;");

        $query->bindValue(':uri', $obj->GetUri(), PDO::PARAM_STR);
        $query->bindValue(':name', $obj->GetName(), PDO::PARAM_STR);
        $query->bindValue(':country', $obj->GetCountry(), PDO::PARAM_STR);
        $query->bindValue(':id', $this->identityMap[$obj], PDO::PARAM_STR);

        try {
            $query->execute();
        } catch (Exception $e) {
            throw new Amm_Collection_EditorException("sql failed");
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

        $query = $this->db->prepare('SELECT uri, name, country FROM collection_editors WHERE id = :id;');
        $query->bindValue(':id', $id, PDO::PARAM_STR);
        $query->execute();

        $result = $query->fetch();

        if (empty($result)) {
            throw new Amm_Collection_EditorMapperException(sprintf('There is no editor with id #%d.', $id));
        }
        $uri = $result['uri'];

        $obj = new Amm_Collection_Editor();
        $this->setAttributeValue($obj, $id, 'id');
        $this->setAttributeValue($obj, $result['name'], 'name');
        $this->setAttributeValue($obj, $result['uri'], 'uri');
        $this->setAttributeValue($obj, $result['country'], 'country');

        $this->identityMap[$obj] = $id;

        return $obj;

    }

    public function findByUri($uri)
    {
        $query = $this->db->prepare('SELECT id FROM collection_editors WHERE uri = :uri LIMIT 1;');
        $query->bindValue(':uri', $uri, PDO::PARAM_STR);
        $query->execute();

        $result = $query->fetch();

        if (empty($result)) {
            throw new Amm_Collection_EditorMapperException(sprintf('There is no editor with uri #%s.', $uri));
        }
        $id = $result['id'];

        if ($id > 0) {
            return $this->findById($id);
        } else {
            throw new Amm_Collection_EditorMapperException(sprintf('The editor with id #%s has id=0?!?.', $uri));
        }
    }


    public function delete(Amm_Collection_Editor $obj)
    {
        if (!isset($this->identityMap[$obj])) {
            throw new Amm_Collection_EditorMapperException('Object has no ID, cannot delete.');
        }
        $query = $this->db->prepare('DELETE FROM collection_editors WHERE id = :id;');
        $query->bindValue(':id', $this->identityMap[$obj], PDO::PARAM_STR);
        $query->execute();
        unset($this->identityMap[$obj]);
    }


   public function getAllEditorsAlphabeticallyOrdered()
    {
        $query = $this->db->prepare('SELECT id, name FROM collection_editors WHERE 1 =1 ORDER BY name;');
        $query->execute();
        $resultPDO = $query->fetchAll();

        $data = array();
        foreach ($resultPDO as $row) {
            $data[$row['id']] = $row['name'];
        }
        return $data;

    }




    private function setAttributeValue(Amm_Collection_Editor $a, $fieldValue, $attributeName)
    {
        $attribute = new ReflectionProperty($a, $attributeName);
        $attribute->setAccessible(TRUE);
        $attribute->setValue($a, $fieldValue);
    }


}