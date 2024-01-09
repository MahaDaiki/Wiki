<?php

class ClassWiki {
    private $wiki_id;
    private $user_id;
    private $category_id;
    private $title;
    private $content;
    private $date_created;
    private $archived;

    private $tag;

    public function __construct($wiki_id, $user_id, $category_id, $title, $content, $date_created, $archived,$tags ) {

        $this->wikiId = $wiki_id;
        $this->userId = $user_id;
        $this->category_id= $category_id;
        $this->title = $title;
        $this->content = $content;
        $this->dateCreated = $date_created ;
        // ?: date('Y-m-d H:i:s');
        $this->archived = $archived;
        $this->tag=$tags;
    }

    /**
     * Get the value of wiki_id
     */ 
    public function getWiki_id() {
        return $this->wiki_id;
    }

    /**
     * Get the value of user_id
     */ 
    public function getUser_id() {
        return $this->user_id;
    }

    /**
     * Get the value of category_name
     */ 
    public function getCategory_id() {
        return $this->category_id;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle() {
        return $this->title;
    }

    /**
     * Get the value of content
     */ 
    public function getContent() {
        return $this->content;
    }

    /**
     * Get the value of date_created
     */ 
    public function getDate_created() {
        return $this->date_created;
    }

    /**
     * Get the value of archived
     */ 
    public function getArchived() {
        return $this->archived;
    }

    /**
     * Get the value of tag
     */ 
    public function getTag()
    {
        return $this->tag;
    }
}

?>

