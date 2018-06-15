<?php
  class EntertaimentProduct {
    public $id;
    public $title;
    public $length;
    public $releaseDate;
    public $producer;
    protected $rate;
    protected $reviews;

    private $db;    
    public function __construct(){
      $this->db = new Database;
    }

    // Get All Articles
    public function getArticles(){
      $this->db->query("SELECT * FROM `articles` ORDER BY `date` DESC;");
      $results = $this->db->resultset();
      return $results;
    }

    // Get Post By ID
    public function getArticleById($id){
      $this->db->query("SELECT * FROM `articles` WHERE id = :id");
      $this->db->bind(':id', $id);
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

    // Update Post
    public function updateArticle($data){
      // Prepare Query
      $this->db->query('UPDATE articles SET title = :title, body = :body WHERE id = :id;');

      // Bind Values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':title', $data['title']);
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