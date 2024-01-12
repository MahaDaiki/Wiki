<?php
include_once 'Model\Connection\Connection.php';
include_once  'Model\Wikis\ClassWikis.php';
class WikisDAO {
    private $pdo;

    public function __construct(){
        $this->pdo = DatabaseConnection::getInstance()->getConnection(); 
    }
   public function displayAllWikis() {
        $query="SELECT * FROM wikis ORDER BY date_created DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $wikisdata=$stmt->fetchAll();
        $wikis = array();
        foreach($wikisdata as $wiki){
            $catdao = new CategoryDAO();
            $cat = $catdao->getCategoryById($wiki['cat_id']);
            $tagdao=new TagsDAO();
            $tags=$tagdao->gettag($wiki['wiki_id']);
            $wikis[] = new ClassWiki($wiki['wiki_id'],$wiki['user_id'], $cat->getCategory_name() ,$wiki['title'],$wiki['content'],$wiki['date_created'],$wiki['archived'],$tags,$wiki['image']);
            // echo $cat->getCategory_name();
       
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

          foreach ($wiki->getTags() as $tag) {
        $query = "INSERT INTO wiki_tags (wiki_id, tag_id) VALUES (:idWiki, :idTag)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':idWiki' => $wiki_id, ':idTag' => $tag]);
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
            $catdao = new CategoryDAO();
            $cat = $catdao->getCategoryById($wiki['cat_id']);
            $tagdao=new TagsDAO();
            $tags=$tagdao->gettag($wiki['wiki_id']);
            $wiki[] = new ClassWiki($wiki['wiki_id'],$wiki['user_id'], $cat->getCategory_name() ,$wiki['title'],$wiki['content'],$wiki['date_created'],$wiki['archived'],$tags,$wiki['image']);
        }

        return $wiki;
    }
    public function displayWikiById($wikiId) {
        $query = "SELECT * FROM wikis WHERE wiki_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$wikiId]);
        $wikidetails = $stmt->fetch(PDO::FETCH_ASSOC);
        $wiki = array();
    
        if ($wikidetails) {
            $userdao = new UserDAO();
            $user = $userdao->getUsernameById($wikidetails['user_id']);
            $catdao = new CategoryDAO();
            $cat = $catdao->getCategoryById($wikidetails['cat_id']);
            $tagdao = new TagsDAO();
            $tags = $tagdao->gettag($wikidetails['wiki_id']);
    
            $wiki[] = new ClassWiki(
                $wikidetails['wiki_id'],
                $user,
                $cat->getCategory_name(),
                $wikidetails['title'],
                $wikidetails['content'],
                $wikidetails['date_created'],
                $wikidetails['archived'],
                $tags,
                $wikidetails['image']


            );
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

//     public function getWikiCount()
// {
//     $query = "SELECT COUNT(*) as count FROM wikis";
//     $result = $this->pdo->prepare($query);
    

//     return $result ? (object) ['count' => $result['count']] : (object) ['count' => 0];
// }

// public function liveSearchWiki($query)
// {
//     $query = "SELECT * FROM wikis WHERE title LIKE :query ";
//     $params = [':query' => '%' . $query . '%'];
//     $results = $this->pdo->prepare($query, $params);

//     return $results;
// }

public function searchWikisByQuery($query)
{
    $input = "%$query%";

    $query = "SELECT DISTINCT w.* FROM wikis w
               JOIN categories c ON w.cat_id = c.cat_id
               JOIN wiki_tags wt ON w.wiki_id = wt.wiki_id
               JOIN tags t ON wt.tag_id = t.tag_id
               WHERE (w.title LIKE :query OR
                      c.category_name LIKE :query OR
                      t.tag LIKE :query)
               AND w.archived = 0";

    // $params = [':query' => $input];
    $stmt = $this->pdo->prepare($query);
    $stmt->execute([':query' => $input]);
    $results =$stmt->fetchAll(PDO::FETCH_ASSOC); 
    $wiki = [];
    foreach ($results as $result) {
        // Assuming the Wiki class constructor and property names
        $userdao = new UserDAO();
            $user = $userdao->getUsernameById($result['user_id']);
            $catdao = new CategoryDAO();
            $cat = $catdao->getCategoryById($result['cat_id']);
            $tagdao = new TagsDAO();
            $tags = $tagdao->gettag($result['wiki_id']);
    
            $wiki[] = new ClassWiki(
                $result['wiki_id'],
                $user,
                $cat->getCategory_name(),
                $result['title'],
                $result['content'],
                $result['date_created'],
                $result['archived'],
                $tags,
                $result['image']


        );
    }

    return $wiki;
}

}

