<?php
include_once('functions/functions.php');
include_once('db/DB.php');
class Post  
{
    private $db;
    public function __construct()
    {
        return $this->db = new DB;
    }

    public function addPost($tile,$des,$img,$date,$slug,$user)
    {
        $this->db->query("INSERT INTO posts (title,description,image,created_at,slug,user) VALUES (:title,:description,:img,:date,:slug,:user)");
        $this->db->bind(':title',$tile);
        $this->db->bind(':description',$des);
        $this->db->bind(':img',$img);
        $this->db->bind(':date',$date);
        $this->db->bind(':slug',$slug);
        $this->db->bind(':user',$user);
       

       $result = $this->db->execute();
       if ($result) {
           if (isset($_POST['tags'])) {
               $tags = $_POST['tags'];
               $lastInsertedId = $this->db->lastInsertId();
               foreach ($tags as $tag ) {
                   $this->db->query("INSERT INTO post_tags (post_id, tag_id) VALUES (:postId,:tagId)");
                   $this->db->bind(':postId',$lastInsertedId);
                   $this->db->bind(':tagId',$tag);
                   $this->db->execute();
               }
           }
       }
       return $result;
    }


    public function getPost()
    {
        if (isset($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            return $this->search($keyword);
        }



        if (isset($_GET['tags'])) {
            $tag = $_GET['tags'];
            $this->db->query("SELECT * FROM posts 
            INNER JOIN post_tags ON posts.id = post_tags.post_id 
            INNER JOIN tags ON tags.id = post_tags.tag_id 
            WHERE tags.tag= :tag ");
            $this->db->bind(':tag',$tag);
            return $result =  $this->db->resultset();
        }

        $limit = 3;
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $start = ($page-1) * $limit;

        $this->db->query("SELECT * FROM posts LIMIT $start,$limit");
        return $result = $this->db->resultset();
        
    }

    public function search($keyword)
    {
        $this->db->query("SELECT * FROM posts WHERE title LIKE :keyword OR description LIKE :keyword");
        $this->db->bind(':keyword','%'.$keyword.'%');
        $this->db->bind(':keyword','%'.$keyword.'%');
        return $result = $this->db->resultset();
      
    }


    public function updatePost($title,$description,$slug){
		$newImage = $_FILES['image']['name'];
		if(!empty($newImage)){
			$image = uploadImage();
			$this->db->query('UPDATE posts SET title = :title,description= :des,image = :image WHERE slug = :slug');
            $this->db->bind(':title',$title);
            $this->db->bind(':des',$description);
            $this->db->bind(':image',$image);
            $this->db->bind(':slug',$slug);
            return $result = $this->db->execute();

		}else{
            $this->db->query('UPDATE posts SET title =:title,description=:des WHERE slug =:slug');
            $this->db->bind(':title',$title);
            $this->db->bind(':des',$description);
            $this->db->bind(':slug',$slug);
            return $this->db->execute();

			
		}
	}

    public function getSinglePost($slug){
        $this->db->query("SELECT * FROM posts WHERE slug = :slug");
        $this->db->bind(':slug',$slug);
        return $result = $this->db->resultset();
    }

    public function deletePost($slug)
    {
        $this->db->query("DELETE FROM posts WHERE slug= :slug");
        $this->db->bind(':slug',$slug);
        return $result = $this->db->execute();
    }

    public function getPopularPosts()
    {
         //if this function won't work then it will be simply solved by changing the sql mode in MySQL by this command,
         // SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));

        $this->db->query("SELECT * FROM posts 
        LEFT JOIN comments ON posts.slug=comments.slug 
        GROUP BY comments.slug 
        ORDER BY COUNT(comments.slug) DESC LIMIT 5");
        return $result = $this->db->resultset();
    }


}


?>