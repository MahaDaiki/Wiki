<?php
include_once 'Model\Connection\Connection.php';
include_once  'Model\Wikis\ClassWikis.php';
include_once 'Model\Tags\TagsDAO.php';
class WikisDAO {
    private $pdo;

    public function __construct(){
        $this->pdo = DatabaseConnection::getInstance()->getConnection(); 
    }
   public function displayAllWikis() {
        $query="SELECT * FROM wikis  Where archived = 0 ORDER BY date_created DESC";
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
        $title=htmlspecialchars($wiki->getTitle());
        $stmt->execute([$wiki->getUser_id(), $wiki->getCat_id(),$title, $wiki->getContent(), $imageFileName]);
    
        // Get the last inserted wiki_id
        $wiki_id = $this->pdo->lastInsertId();
    
        // Insert tags into wiki_tags table

          foreach ($wiki->getTags() as $tag) {
        $query = "INSERT INTO wiki_tags (wiki_id, tag_id) VALUES (:idWiki, :idTag)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':idWiki' => $wiki_id, ':idTag' => $tag]);
    }
    }

    
    

    public function modifyWiki($wiki, $imageFileName) {
        
//   var_dump($wiki->getWiki_id());
            // var_dump($wiki->getTags());
            $queryWikis = "UPDATE wikis SET cat_id = ?, title = ?, content = ?, image = ? WHERE wiki_id = ?";
            $title=htmlspecialchars($wiki->getTitle());
            $stmtWikis = $this->pdo->prepare($queryWikis);
            $stmtWikis->execute([$wiki->getCat_id(), $title, $wiki->getContent(), $imageFileName, $wiki->getWiki_id()]);

            $queryDeleteTags = "DELETE FROM wiki_tags WHERE wiki_id = ?";
            $stmtDeleteTags = $this->pdo->prepare($queryDeleteTags);
            $stmtDeleteTags->execute([$wiki->getWiki_id()]);
          
            foreach ($wiki->getTags() as $tag) {
                $query = "INSERT INTO wiki_tags (wiki_id, tag_id) VALUES (:idWiki, :idTag)";
                $stmt = $this->pdo->prepare($query);
                $stmt->execute([':idWiki' => $wiki->getWiki_id(), ':idTag' => $tag]);
            }
          
       
    }
    
    
    public function displayWiki($User_id) {
        $query = "SELECT * FROM wikis WHERE user_id = ? and archived = 0 ORDER BY date_created DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$User_id]);
        
        $wikidetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $wikis = array();
    
        foreach ($wikidetails as $wikiDetails) {
            $catdao = new CategoryDAO();
            $cat = $catdao->getCategoryById($wikiDetails['cat_id']);
            $tagdao = new TagsDAO();
            $tags = $tagdao->gettag($wikiDetails['wiki_id']);
            
            $wikis[] = new ClassWiki(
                $wikiDetails['wiki_id'],
                $wikiDetails['user_id'],
                $cat->getCategory_name(),
                $wikiDetails['title'],
                $wikiDetails['content'],
                $wikiDetails['date_created'],
                $wikiDetails['archived'],
                $tags,
                $wikiDetails['image']
            );
        }
    
        return $wikis;
    }
    
    public function displayWikiById($wikiId) {
        $query = "SELECT * FROM wikis WHERE wiki_id = ? ";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$wikiId]);
        $wikidetails = $stmt->fetch(PDO::FETCH_ASSOC);
        // $wiki = array();
    
        if ($wikidetails) {
            $userdao = new UserDAO();
            $user = $userdao->getUsernameById($wikidetails['user_id']);
            $catdao = new CategoryDAO();
            $cat = $catdao->getCategoryById($wikidetails['cat_id']);
            $tagdao = new TagsDAO();
            $tags = $tagdao->gettag($wikidetails['wiki_id']);
    
            $wikid = new ClassWiki(
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
    
        return $wikid;
    }
    

    public function deleteWiki($wikiId) {
        $queryDeleteTags = "DELETE FROM wiki_tags WHERE wiki_id = ?";
        $stmtDeleteTags = $this->pdo->prepare($queryDeleteTags);
        $stmtDeleteTags->execute([$wikiId]);
        $query="DELETE FROM wikis WHERE wiki_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$wikiId]);
      

    }

    public function archiveWiki($wikiId) {
        $query="UPDATE wikis SET archived = 1 WHERE wiki_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$wikiId]);
    }

    public function getTagsForWiki($wiki_id)
    {
        $query = "SELECT * FROM wiki_tags where wiki_id = $wiki_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $tags = array();
        foreach ($result as $row) {
            $tagDao = new  TagsDAO();
            $tagbyid = $tagDao->getTagById($row['tag_id']);
            $tags[] = $tagbyid;
        }
        return $tags;
    }


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


    public function getWikisPerUser() {
      
            $sql = "SELECT u.username, COUNT(w.wiki_id) as wiki_count
                    FROM users u
                    LEFT JOIN wikis w ON u.user_id = w.user_id
                    WHERE u.role = 'auteur'
                    GROUP BY u.user_id, u.username";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            $userData = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $userData[$row['username']] = $row['wiki_count'];
            }

            return $userData;
      
    }

    public function getWikisPerCategory() {
        
            $sql = "SELECT c.category_name, COUNT(w.wiki_id) as wiki_count
                    FROM categories c
                    LEFT JOIN wikis w ON c.cat_id = w.cat_id
                    GROUP BY c.cat_id, c.category_name";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            $categoryData = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $categoryData[$row['category_name']] = $row['wiki_count'];
            }

            return $categoryData;
     
    }

  
}




