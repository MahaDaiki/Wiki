<?php

class Wiki {
    private $wiki_id;
    private $user_id;
    private $category_name;
    private $title;
    private $content;
    private $date_created;
    private $archived;

    public function __construct($wiki_id, $user_id, $category_name, $title, $content, $date_created, $archived ) {

        $this->wikiId = $wiki_id;
        $this->userId = $user_id;
        $this->categoryName = $category_name;
        $this->title = $title;
        $this->content = $content;
        $this->dateCreated = $date_created ;
        // ?: date('Y-m-d H:i:s');
        $this->archived = $archived;
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
    public function getCategory_name() {
        return $this->category_name;
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
}

?>

