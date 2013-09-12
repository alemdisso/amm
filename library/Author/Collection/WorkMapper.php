<?php

class Author_Collection_WorkMapper
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
        $query = $this->db->prepare('SELECT id FROM collection_works WHERE 1=1;');
        $query->execute();
        $resultPDO = $query->fetchAll();

        $result = array();
        foreach ($resultPDO as $row) {
            $result[] = $row['id'];
        }
        return $result;

    }

    public function insert(Author_Collection_Work $obj)
    {

        $query = $this->db->prepare("INSERT INTO collection_works (uri, title, description, summary, type)
            VALUES (:uri, :title, :description, :summary, :type)");

        $query->bindValue(':uri', $obj->GetUri(), PDO::PARAM_STR);
        $query->bindValue(':title', $obj->GetTitle(), PDO::PARAM_STR);
        $query->bindValue(':description', $obj->GetDescription(), PDO::PARAM_STR);
        $query->bindValue(':summary', $obj->GetSummary(), PDO::PARAM_STR);
        $query->bindValue(':type', $obj->GetType(), PDO::PARAM_STR);

        $query->execute();

        $obj->SetId((int)$this->db->lastInsertId());
        $this->identityMap[$obj] = $obj->GetId();

    }

    public function update(Author_Collection_Work $obj)
    {
        if (!isset($this->identityMap[$obj])) {
            throw new Author_Collection_WorkMapperException('Object has no ID, cannot update.');
        }

        $query = $this->db->prepare("UPDATE collection_works SET uri = :uri, title = :title, description = :description, summary = :summary, type = :type WHERE id = :id;");

        $query->bindValue(':uri', $obj->GetUri(), PDO::PARAM_STR);
        $query->bindValue(':title', $obj->GetTitle(), PDO::PARAM_STR);
        $query->bindValue(':description', $obj->GetDescription(), PDO::PARAM_STR);
        $query->bindValue(':summary', $obj->GetSummary(), PDO::PARAM_STR);
        $query->bindValue(':type', $obj->GetType(), PDO::PARAM_STR);
        $query->bindValue(':id', $this->identityMap[$obj], PDO::PARAM_STR);

        try {
            $query->execute();
        } catch (Exception $e) {
            throw new Author_Collection_WorkException("sql failed");
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

        $query = $this->db->prepare('SELECT uri, title, description, summary, type FROM collection_works WHERE id = :id;');
        $query->bindValue(':id', $id, PDO::PARAM_STR);
        $query->execute();

        $result = $query->fetch();

        if (empty($result)) {
            throw new Author_Collection_WorkMapperException(sprintf('There is no work with id #%d.', $id));
        }
        $uri = $result['uri'];

        $obj = new Author_Collection_Work();
        $this->setAttributeValue($obj, $id, 'id');
        $this->setAttributeValue($obj, $result['title'], 'title');
        $this->setAttributeValue($obj, $result['uri'], 'uri');
        $this->setAttributeValue($obj, $result['description'], 'description');
        $this->setAttributeValue($obj, $result['summary'], 'summary');
        $this->setAttributeValue($obj, $result['type'], 'type');


        $this->identityMap[$obj] = $id;

        return $obj;

    }

    public function findByUri($uri)
    {
        $query = $this->db->prepare('SELECT id FROM collection_works WHERE uri = :uri LIMIT 1;');
        $query->bindValue(':uri', $uri, PDO::PARAM_STR);
        $query->execute();

        $result = $query->fetch();

        if (empty($result)) {
            throw new Author_Collection_WorkMapperException(sprintf('There is no work with uri #%s.', $uri));
        }
        $id = $result['id'];

        if ($id > 0) {
            return $this->findById($id);
        } else {
            throw new Author_Collection_WorkMapperException(sprintf('The work with id #%s has id=0?!?.', $uri));
        }

    }


    public function delete(Author_Collection_Work $obj)
    {
        if (!isset($this->identityMap[$obj])) {
            throw new Author_Collection_WorkMapperException('Object has no ID, cannot delete.');
        }
        $query = $this->db->prepare('DELETE FROM collection_works WHERE id = :id;');
        $query->bindValue(':id', $this->identityMap[$obj], PDO::PARAM_STR);
        $query->execute();
        unset($this->identityMap[$obj]);
    }


    private function setAttributeValue(Author_Collection_Work $a, $fieldValue, $attributeName)
    {
        $attribute = new ReflectionProperty($a, $attributeName);
        $attribute->setAccessible(TRUE);
        $attribute->setValue($a, $fieldValue);
    }


    public function getAllIdsOfType($type)
    {
        $query = $this->db->prepare('SELECT id FROM collection_works WHERE type=:type;');
        $query->bindValue(':type', $type, PDO::PARAM_STR);
        $query->execute();
        $resultPDO = $query->fetchAll();

        $result = array();
        foreach ($resultPDO as $row) {
            $result[] = $row['id'];
        }
        return $result;

    }




}