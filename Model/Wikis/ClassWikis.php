<?php

class ClassWiki {
    private $wiki_id;
    private $user_id;
    private $cat_id;
    private $title;
    private $content;
    private $date_created;
    private $archived;

    private $tags;

    private $image;

    public function __construct($wiki_id, $user_id, $cat_id, $title, $content, $date_created, $archived,$tags,$image ) {

        $this->wiki_id = $wiki_id;
        $this->user_id = $user_id;
        $this->cat_id= $cat_id;
        $this->title = $title;
        $this->content = $content;
        $this->date_created = $date_created ;
        // date('Y-m-d H:i:s');
        $this->archived = $archived;
        $this->tags=$tags;
        $this->image=$image;

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
    public function getCat_id() {
        return $this->cat_id;
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
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }
}

?>

