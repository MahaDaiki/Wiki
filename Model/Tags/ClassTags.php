<?php
class ClassTag {
    private $tag_id;
    private $tag;

    public function __construct($tag_id,$tag) {
        $this->tag_id=$tag_id;
        $this->tag = $tag;
    }
    /**
     * Get the value of tag_id
     */ 
    public function getTag_id()
    {
        return $this->tag_id;
    }

    /**
     * Get the value of tag
     */ 
    public function getTag() {
        return $this->tag;
    }

}
?>