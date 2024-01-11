<?php
include_once 'Model\Connection\Connection.php';
include_once  'Model\Wikis\ClassWikis.php';
class WikisDAO {
    private $pdo;

    public function __construct(){
        $this->pdo = DatabaseConnection::getInstance()->getConnection(); 
    }
   public function displayAllWikis() {
        $query="SELECT * FROM wikis";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $wikisdata=$stmt->fetchAll();
        $wikis = array();
        foreach($wikisdata as $wiki){
            $tagdaw=new TagsDAO();
            $tags=$tagdaw->gettag($wiki['wiki_id']);
            $wikis[] = new ClassWiki($wiki['wiki_id'],$wiki['user_id'],$wiki['category_name'],$wiki['title'],$wiki['content'],$wiki['date_created'],$wiki['archived'],$tags);

        
        }
        return $wikis;
    }

    public function addWiki($wiki, $imageFileName) {
        // Insert into wikis table
        $query = "INSERT INTO wikis (user_id, cat_id, title, content, image) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$wiki->getUser_id(), $wiki->getCat_id(), $wiki->getTitle(), $wiki->getContent(), $imageFileName]);
    
        // Get the last inserted wiki_id
        $wiki_id = $this->pdo->lastInsertId();
    
        // Insert tags into wiki_tags table
        foreach ($wiki->getTag() as $tag) {
            $query = "INSERT INTO wiki_tags (wiki_id, tag_id) VALUES (?, ?)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$wiki_id, $tag->getTag_id()]);
        }
    }
    
    

    public function modifyWiki($wiki) {
        $query="UPDATE wikis SET category_name = ?, title = ?, content = ? WHERE wiki_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$wiki->getCategory_name(), $wiki->getTitle(), $wiki->getContent(), $wiki->getWiki_id()]);
    }

    public function displayWiki($userId) {
       $query="SELECT * FROM wikis WHERE user_id = ?";
       $stmt = $this->pdo->prepare($query);
    $stmt->execute([$userId]);
        $wikidetails=$stmt->fetch(PDO::FETCH_ASSOC);
        $wiki=array();
        if($wikidetails){
            //define tags
            
            $wiki[] = new ClassWiki($wiki['wiki_id'],$wiki['user_id'],$wiki['category_name'],$wiki['title'],$wiki['content'],$wiki['date_created'],$wiki['archived'],$tags,$wiki['image']);
        }

        return $wiki;
    }

    public function deleteWiki($wikiId) {
        $query="DELETE FROM wikis WHERE wiki_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$wikiId]);
    }

    public function archiveWiki($wikiId) {
        $query="UPDATE wikis SET archived = 1 WHERE wiki_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$wikiId]);
    }
}

