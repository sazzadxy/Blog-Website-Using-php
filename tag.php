<?php
include_once('db/DB.php');
class Tag  
{
    private $db;
    public function __construct()
    {
        return $this->db = new DB;
    }

    public function getAllTags()
    {
        $this->db->query("SELECT * FROM tags");
        return $result = $this->db->resultset();

    }

    public function addTags($tag)
    {
        $this->db->query("INSERT INTO tags(tag) VALUES (:tag)");
        $this->db->bind(':tag',$tag);
        return $result = $this->db->execute();

    }

    public function updateTags($tag,$id)
    {
        $this->db->query("UPDATE tags SET tag =:tag WHERE id = :id");
        $this->db->bind(':tag',$tag);
        $this->db->bind(':id',$id);
        return $result = $this->db->execute();
    }

    public function deleteTags($id)
    {
        $this->db->query("DELETE FROM tags WHERE id = :id");
        $this->db->bind(':id',$id);
        return $this->db->execute();
    }

  
}



?>