<?php
require_once('db/DB.php');

class Comment
{
    private $db;
    public function __construct()
    {
        $this->db = new DB;
    }

    public function comment($name, $email, $subject, $description, $slug, $date,$status)
    {
        $this->db->query("INSERT INTO comments (name,email,subject,description,slug,created_at,status) VALUES (:name,:email,:subject,:des,:slug,:date,:status)");
        $this->db->bind(':name', $name);
        $this->db->bind(':email', $email);
        $this->db->bind(':subject', $subject);
        $this->db->bind(':des', $description);
        $this->db->bind(':slug', $slug);
        $this->db->bind(':date',$date);
        $this->db->bind(':status',$status);
        return $result = $this->db->execute();
    }


    function getCommentsBySlug($slug){
        $this->db->query("SELECT * FROM comments WHERE slug = :slug AND status = 1");
        $this->db->bind(':slug',$slug);
        return $result = $this->db->resultset();
    }

    function countComments($slug){
        $this->db->query("SELECT * FROM comments WHERE slug = :slug AND status = 1");
        $this->db->bind(':slug',$slug);
        $this->db->resultset();
        return $result = $this->db->rowCount();
    }

    function getPendingComments(){
        $this->db->query("SELECT * FROM comments WHERE  status = 0");
        return $result = $this->db->resultset();
    }

    function updateComments($id)
    {
        $this->db->query("UPDATE comments SET status = 1 WHERE id = :id");
        $this->db->bind(':id',$id);
        return $result = $this->db->execute();

    }

    public function deleteComments($id)
    {
        $this->db->query("DELETE FROM comments WHERE id= :id");
        $this->db->bind(':id',$id);
        return $result = $this->db->execute();

    }
}
