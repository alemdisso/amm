<?php

class Moxca_Blog_PostMapper
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
        $query = $this->db->prepare('SELECT id FROM moxca_blog_posts WHERE 1=1;');
        $query->execute();
        $resultPDO = $query->fetchAll();

        $result = array();
        foreach ($resultPDO as $row) {
            $result[] = $row['id'];
        }
        return $result;

    }

    public function insert(Moxca_Blog_Post $obj)
    {

        $query = $this->db->prepare("INSERT INTO moxca_blog_posts (uri, title, summary,
                            content, category, publication_date, creation_date,
                            last_edition_date, author, author_name, status)
                            VALUES (:uri, :title, :summary, :content, :category,
                            :publication_date, :creation_date, :last_edition_date,
                            :author, :author_name, :status)");

        $query->bindValue(':uri', $obj->getUri(), PDO::PARAM_STR);
        $query->bindValue(':title', $obj->getTitle(true), PDO::PARAM_STR);
        $query->bindValue(':summary', $obj->getSummary(), PDO::PARAM_STR);
        $query->bindValue(':content', $obj->getContent(), PDO::PARAM_STR);
        $query->bindValue(':category', $obj->getCategory(), PDO::PARAM_STR);
        $query->bindValue(':publication_date', $obj->getPublicationDate(), PDO::PARAM_STR);
        $query->bindValue(':creation_date', $obj->getCreationDate(), PDO::PARAM_STR);
        $query->bindValue(':last_edition_date', $obj->getLastEditionDate(), PDO::PARAM_STR);
        $query->bindValue(':author', $obj->getAuthor(), PDO::PARAM_STR);
        $query->bindValue(':author_name', $obj->getAuthorName(), PDO::PARAM_STR);
        $query->bindValue(':status', $obj->getStatus(), PDO::PARAM_STR);

        $query->execute();

        $obj->setId((int)$this->db->lastInsertId());
        $this->identityMap[$obj] = $obj->getId();

    }

    public function update(Moxca_Blog_Post $obj)
    {
        if (!isset($this->identityMap[$obj])) {
            throw new Moxca_Blog_PostMapperException('Object has no ID, cannot update.');
        }

        $query = $this->db->prepare("UPDATE moxca_blog_posts SET uri = :uri, title = :title
            , summary = :summary, content = :content, category = :category
            , publication_date = :publication_date, creation_date = :creation_date
            , last_edition_date = :last_edition_date, author = :author
            , author_name = :author_name, status = :status WHERE id = :id;");

        $query->bindValue(':uri', $obj->getUri(), PDO::PARAM_STR);
        $query->bindValue(':title', $obj->getTitle(true), PDO::PARAM_STR);
        $query->bindValue(':summary', $obj->getSummary(), PDO::PARAM_STR);
        $query->bindValue(':content', $obj->getContent(), PDO::PARAM_STR);
        $query->bindValue(':category', $obj->getCategory(), PDO::PARAM_STR);
        $query->bindValue(':publication_date', $obj->getPublicationDate(), PDO::PARAM_STR);
        $query->bindValue(':creation_date', $obj->getCreationDate(), PDO::PARAM_STR);
        $query->bindValue(':last_edition_date', $obj->getLastEditionDate(), PDO::PARAM_STR);
        $query->bindValue(':author', $obj->getAuthor(), PDO::PARAM_STR);
        $query->bindValue(':author_name', $obj->getAuthorName(), PDO::PARAM_STR);
        $query->bindValue(':status', $obj->getStatus(), PDO::PARAM_STR);
        $query->bindValue(':id', $this->identityMap[$obj], PDO::PARAM_STR);

        try {
            $query->execute();
        } catch (Exception $e) {
            throw new Moxca_Blog_PostException("sql failed");
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

        $query = $this->db->prepare('SELECT uri, title, summary, content,
                            category, publication_date, creation_date,
                            last_edition_date, author, author_name, status
                            FROM moxca_blog_posts WHERE id = :id;');
        $query->bindValue(':id', $id, PDO::PARAM_STR);
        $query->execute();

        $result = $query->fetch();

        if (empty($result)) {
            throw new Moxca_Blog_PostMapperException(sprintf('There is no post with id #%d.', $id));
        }
        $uri = $result['uri'];

        $obj = new Moxca_Blog_Post();
        $this->setAttributeValue($obj, $id, 'id');
        $this->setAttributeValue($obj, $result['title'], 'title');
        $this->setAttributeValue($obj, $result['uri'], 'uri');
        $this->setAttributeValue($obj, $result['summary'], 'summary');
        $this->setAttributeValue($obj, $result['content'], 'content');
        $this->setAttributeValue($obj, $result['category'], 'category');
        $this->setAttributeValue($obj, $result['publication_date'], 'publicationDate');
        $this->setAttributeValue($obj, $result['creation_date'], 'creationDate');
        $this->setAttributeValue($obj, $result['last_edition_date'], 'lastEditionDate');
        $this->setAttributeValue($obj, $result['author'], 'author');
        $this->setAttributeValue($obj, $result['author_name'], 'authorName');
        $this->setAttributeValue($obj, $result['status'], 'status');


        $this->identityMap[$obj] = $id;

        return $obj;

    }

    public function findByUri($uri)
    {
        $query = $this->db->prepare('SELECT id FROM moxca_blog_posts WHERE uri = :uri LIMIT 1;');
        $query->bindValue(':uri', $uri, PDO::PARAM_STR);
        $query->execute();

        $result = $query->fetch();

        if (empty($result)) {
            throw new Moxca_Blog_PostMapperException(sprintf('There is no post with uri #%s.', $uri));
        }
        $id = $result['id'];

        if ($id > 0) {
            return $this->findById($id);
        } else {
            throw new Moxca_Blog_PostMapperException(sprintf('The post with id #%s has id=0?!?.', $uri));
        }

    }

    public function delete(Moxca_Blog_Post $obj)
    {
        if (!isset($this->identityMap[$obj])) {
            throw new Moxca_Blog_PostMapperException('Object has no ID, cannot delete.');
        }
        $query = $this->db->prepare('DELETE FROM moxca_blog_posts WHERE id = :id;');
        $query->bindValue(':id', $this->identityMap[$obj], PDO::PARAM_STR);
        $query->execute();

        unset($this->identityMap[$obj]);
    }

    private function setAttributeValue(Moxca_Blog_Post $a, $fieldValue, $attributeName)
    {
        $attribute = new ReflectionProperty($a, $attributeName);
        $attribute->setAccessible(TRUE);
        $attribute->setValue($a, $fieldValue);
    }

}