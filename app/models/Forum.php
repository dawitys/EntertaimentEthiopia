<?php

class Forum
{
    public $title;
    public $catagory;
    private $thoughts;
    private $participants;

    private $db;    
    public function __construct(){
      $this->db = new Database;
    }

    // add a thought to a forum
    public function addThought($thought){
      //implementation based on database
    }

    // add a participant to a forum
    public function addParticipant($participant)
    {
      //implementation based on database
    }
    // add a thought to a forum
    public function updateForum($title)
    {
      //implementation based on database
    }

    // Update Post
    public function updateForum($data)
    {
        // Prepare Query
        $this->db->query('UPDATE forums SET title = :title, body = :body WHERE id = :id;');

        // Bind Values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllForums(){
      $this->db->query("SELECT * FROM `forum` ORDER BY `date` DESC;");
      $results = $this->db->resultset();
      return $results;
    }
    public function getRecentForums($limit=10){
      $this->db->query("SELECT * FROM `forum` ORDER BY `date` DESC LIMIT :lim");
      $this->db->bind(':lim', $limit);
      $results = $this->db->resultset();
      return $results;
    }
    // Get Post By title
    public function getForum($title){
      $this->db->query("SELECT * FROM `forum` WHERE title = :title");
      $this->db->bind(':title', $title);
      $row = $this->db->single();
      return $row;
    }

    // Add Post
    public function postArticle($data){
      // Prepare Query
      $this->db->query('INSERT INTO artiles (title, user_id, body) VALUES (:title, :user_id, :body)');

      // Bind Values
      $this->db->bind(':title', $data['title']);
      $this->db->bind(':user_id', $data['user_id']);
      $this->db->bind(':body', $data['body']);
      
      //Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
    // Delete Post
    public function deleteArticle($id){
      // Prepare Query
      $this->db->query('DELETE FROM articles WHERE id = :id');

      // Bind Values
      $this->db->bind(':id', $id);
      
      //Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
  }