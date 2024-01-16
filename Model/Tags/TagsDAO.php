<?php

include_once 'Model\Connection\Connection.php';
include_once 'Model\Tags\ClassTags.php';

class TagsDAO {
    private $pdo;

    public function __construct(){
        $this->pdo = DatabaseConnection::getInstance()->getConnection(); 
    }

    public function addTag($Tag) {
        $tagName = htmlspecialchars($Tag->getTag());
        $query = "INSERT INTO tags (tag_id, tag) VALUES (0,'".$tagName."')";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
    }
    public function gettag($idWIKI){
        $query = "SELECT * FROM tags inner join wiki_tags on tags.tag_id=wiki_tags.tag_id and wiki_tags.wiki_id=$idWIKI ";
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
        $query = "SELECT * FROM tags ORDER BY tag_id DESC";
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
        $tags =  htmlspecialchars($tag->getTag());
        $stmt->execute([$tags, $tag->getTag_id()]);
    }
    
    public function deleteTag($tag) {
        $query = "DELETE FROM wiki_tags WHERE tag_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$tag]);
        $query = "DELETE FROM tags WHERE tag_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$tag]);
    }

    public function getTagIdsByNames($tagNames) {
        $tagIds = [];

        foreach ($tagNames as $tagName) {
            $query = "SELECT tag_id FROM tags WHERE tag = ?";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$tagName]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $tagIds[] = $result['tag_id'];
                return $tagIds;
            }
            else 
            return NULL;
        }
    }
}
?>
