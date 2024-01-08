<?php
class ClassTag {
    private $tag;

    public function __construct($tag) {
        $this->tag = $tag;
    }

    /**
     * Get the value of tag
     */ 
    public function getTag() {
        return $this->tag;
    }
}
?>