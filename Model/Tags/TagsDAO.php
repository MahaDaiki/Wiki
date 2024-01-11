<?php

include_once 'Model\Connection\Connection.php';
include_once 'Model\Tags\ClassTags.php';

class TagsDAO {
    private $pdo;

    public function __construct(){
        $this->pdo = DatabaseConnection::getInstance()->getConnection(); 
    }

    public function addTag($Tag) {
        $query = "INSERT INTO tags (tag_id, tag) VALUES (0,'".$Tag->getTag()."')";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
    }
    public function gettag($idWIKI){
        $query = "SELECT * FROM tags inner join wikitag on  idtag=wikitag.idtag and wikitag.idwiki=$idWIKI ";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $tagsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $tags = array();
        foreach ($tagsData as $tagData) {
            $tags[] = new ClassTag($tagData['tag_id'],$tagData['tag']);
        }

        return $tags;

    }

    public function getTagById($tagId) {
        $query = "SELECT * FROM tags WHERE tag_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$tagId]);
        $tagData = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($tagData) {
            return new ClassTag($tagData['tag_id'], $tagData['tag']);
        }
    
        return null; 
    }
    
    public function getAllTags() {
        $query = "SELECT * FROM tags";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $tagsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $tags = array();
        foreach ($tagsData as $tagData) {
            $tags[] = new ClassTag($tagData['tag_id'],$tagData['tag']);
        }

        return $tags;
    }


    public function updateTag($tag) {
        $query = "UPDATE tags SET tag = ? WHERE tag_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$tag->getTag(), $tag->getTag_id()]);
    }
    
    public function deleteTag($tag) {
        $query = "DELETE FROM tags WHERE tag_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$tag->getTag_id()]);
    }
}

?>
