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

    public function addWiki($wiki) {
        $query="INSERT INTO wikis (user_id, category_name, title, content) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$wiki->getUser_id(), $wiki->getCategory_name(), $wiki->getTitle(), $wiki->getContent()]);
        foreach($wiki->getTag() as $tag){
            $query="INSERT INTO wikistag values(1,$tag->getIDtag())";
//get last id function  fblast 1 to insert dkshi
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
            $wiki[] = new ClassWiki($wiki['wiki_id'],$wiki['user_id'],$wiki['category_name'],$wiki['title'],$wiki['content'],$wiki['date_created'],$wiki['archived']);
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

