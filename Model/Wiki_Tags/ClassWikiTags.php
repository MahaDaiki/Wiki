<?php

class ClassWikiTag {
    private $wiki_id;
    private $tag;

    public function __construct($wiki_id, $tag) {
      

        $this->wiki_id = $wiki_id;
        $this->tag = $tag;
    }

    /**
     * Get the value of wiki_id
     */ 
    public function getWiki_id() {
        return $this->wiki_id;
    }

    /**
     * Get the value of tag
     */ 
    public function getTag() {
        return $this->tag;
    }
}

?>
