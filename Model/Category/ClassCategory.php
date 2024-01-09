<?php
class ClassCategory {
    private $cat_id;
    private $category_name;
    private $cat_date_created;

    public function __construct($cat_id,$category_name,$cat_date_created) {
        $this->cat_id=$cat_id;
        $this->category_name = $category_name;
        $this->cat_date_created =$cat_date_created;
    }

    /**
     * Get the value of category_name
     */ 
    public function getCategory_name() {
        return $this->category_name;
    }

    /**
     * Get the value of cat_id
     */ 
    public function getCat_id()
    {
        return $this->cat_id;
    }

    /**
     * Get the value of cat_date_created
     */ 
    public function getCat_date_created()
    {
        return $this->cat_date_created;
    }
}