<?php

class Moxca_Blog_Post {

    protected $id;
    protected $title;
    protected $uri;
    protected $summary;
    protected $content;
    protected $creationDate;
    protected $lastEditionDate;
    protected $author;
    protected $authorName;
    protected $status;

    function __construct($id=0) {
        $this->id = (int)$id;
        $this->title = "";
        $this->uri = "";
        $this->summary = "";
        $this->content = "";
        $this->creationDate = null;
        $this->lastEditionDate = null;
        $this->author = null;
        $this->authorName = "";
        $this->status = null;
    }

    public function getId() {
        return $this->id;

    } //getId

    public function setId($id) {
        if (($this->id == 0) && ($id > 0)) {
            $this->id = (int)$id;
        } else {
            throw new Moxca_Blog_PostException('It\'s not possible to change a post\'s ID');
        }

    } //SetId

    public function getAuthor()
    {
        return $this->author;
    } //getAuthor

    public function setAuthor($author)
    {
        $validator = new Moxca_Util_ValidPositiveDecimal();
        if ($validator->isValid($author)) {
            if ($this->author != $author) {
                $this->author = $author;
            }
        } else {
            throw new Moxca_Blog_PostException("This ($author) is not a valid author id.");
        }
    } //SetAuthor

    public function getAuthorName()
    {
        return $this->authorName;
    } //getAuthorName

    public function setAuthorName($authorName)
    {
        $validator = new Moxca_Util_ValidString();
        if (($validator->isValid($authorName)) || ($authorName == "")) {
            if ($this->authorName != $authorName) {
                $this->authorName = $authorName;
            }
        } else {
            throw new Moxca_Blog_PostException("This ($authorName) is not a valid name.");
        }

    } //SetAuthorName

    public function getContent()
    {
        return $this->content;
    } //getContent

    public function setContent($content)
    {
        $validator = new Moxca_Util_ValidMarkup();
        if ($validator->isValid($content)) {
            if ($this->content != $content) {
                $this->content = $content;
            }
        } else {
            throw new Moxca_Blog_PostException("This ($content) is not a valid content.");
        }
    } //SetContent

    public function getCreationDate()
    {
        return $this->creationDate;
    } //GetCreationDate

    public function setCreationDate($creationDate)
    {
        if ($creationDate != "") {
            $dateValidator = new Moxca_Util_ValidDate();
            if ($dateValidator->isValid($creationDate)) {
                if ($this->creationDate != $creationDate) {
                    $this->creationDate = $creationDate;
                }
            } else {
                throw new Moxca_Blog_PostException("This ($creationDate) is not a valid date.");
            }
        }
    } //SetCreationDate

    public function getLastEditionDate()
    {
        return $this->lastEditionDate;
    } //GetLastEditionDate

    public function setLastEditionDate($lastEditionDate)
    {
        if ($lastEditionDate != "") {
            $dateValidator = new Moxca_Util_ValidDate();
            if ($dateValidator->isValid($lastEditionDate)) {
                if ($this->lastEditionDate != $lastEditionDate) {
                    $this->lastEditionDate = $lastEditionDate;
                }
            } else {
                throw new Moxca_Blog_PostException("This ($lastEditionDate) is not a valid date.");
            }
        }
    } //SetLastEditionDate

    public function getSummary()
    {
        return $this->summary;
    } //getSummary

    public function setSummary($summary)
    {
        $validator = new Moxca_Util_ValidLongString();
        if ($validator->isValid($summary)) {
            if ($this->summary != $summary) {
                $this->summary = $summary;
            }
        } else {
            throw new Moxca_Blog_PostException("This ($summary) is not a valid summary.");
        }
    } //SetSummary

    public function getTitle()
    {
        return $this->title;
    } //getTitle

    public function setTitle($title)
    {
        $prefix = "";
        $validator = new Moxca_Util_ValidString();
        if ($validator->isValid($title)) {
            if ($this->title != $title) {

                $this->title = $title;
                $converter = new Moxca_Util_StringToAscii();
                $this->uri = $converter->toAscii($this->getTitle());
            }
        } else {
            throw new Moxca_Blog_PostException("This ($title) is not a valid title.");
        }

    } //SetTitle

    public function setStatus($status)
    {
        switch ($status) {
            case Moxca_Blog_PostStatusConstants::STATUS_NIL:
            case Moxca_Blog_PostStatusConstants::STATUS_DRAFT:
            case Moxca_Blog_PostStatusConstants::STATUS_PUBLISHED:
            case Moxca_Blog_PostStatusConstants::STATUS_PROTECTED:
            case Moxca_Blog_PostStatusConstants::STATUS_ARCHIVED:
                $this->status = (int)$status;
                break;

            case null:
            case "":
            case 0:
            case false:
                $this->status = null;
                break;

            default:
                throw new Moxca_Blog_ProjectException("Invalid project status.");
                break;
        }
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getUri()
    {
        return $this->uri;
    } //getUri

}