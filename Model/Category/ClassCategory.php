<?php
class ClassCategory {
    private $category_name;

    public function __construct($category_name) {
        $this->category_name = $category_name;
    }

    /**
     * Get the value of category_name
     */ 
    public function getCategory_name() {
        return $this->category_name;
    }
}