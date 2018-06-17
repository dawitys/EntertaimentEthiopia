<?php

class Article
{
      public $id;
      public $title;
      public $content;
      public $catagory;
      public $importance;
      public $releaseDate;
      public $source;
    public $image;


    public function __construct($id = null, $title = null, $content = null, $catagory = null, $importance = 1, $releaseDate = null, $source = null, $image = null)
    {
          $this->id = $id;
          $this->title = $title;
          $this->content = $content;
          $this->catagory = $catagory;
          $this->importance = $importance;
          $this->releaseDate = $releaseDate;
          $this->source = $source;
        $this->image = $image;
      }

    // Get All Articles
    public static function getAllArticles()
    {
        $list = [];
        Database::getInstance()->query("SELECT * FROM `articles` ORDER BY `date` DESC;");
        $results = Database::getInstance()->resultset();
        foreach ($results as $article) {
            $list[] = new Article($article->id, $article->title, $article->content,
                $article->catagory, $article->importance, $article->date, $article->source, $article->image);
        }
        return $list;

    }

    // Get Post By ID
    public static function getArticleById($data)
    {
        Database::getInstance()->query("SELECT * FROM `articles` WHERE id = :title");
        Database::getInstance()->bind(':title', $data);
          $article = Database::getInstance()->single();

          return new Article($article->id, $article->title, $article->content,
              $article->catagory, $article->importance, $article->date, $article->source, $article->image);
    }

    // Add Post
    public function postArticle($data){
      // Prepare Query
        Database::getInstance()->query("INSERT INTO `articles` (`title`, `catagory`, `content`, `importance`, `source`, `date`) VALUES (:tit ,:cat ,:con ,:impo ,:src , NOW());");

      // Bind Values
        Database::getInstance()->bind(':tit', $data['title']);
        Database::getInstance()->bind(':cat', $data['catagory']);
        Database::getInstance()->bind(':con', $data['content']);
        Database::getInstance()->bind(':impo', $data['importance']);
        Database::getInstance()->bind(':src', $data['source']);
      
      //Execute
        if (Database::getInstance()->execute()) {
        return true;
      } else {
        return false;
      }
    }

    // Update Post
    public function updateArticle($data){
      // Prepare Query
        Database::getInstance()->query("UPDATE `articles` SET `title` = ':tit', `content` = ':con', `source` = 'src' WHERE `articles`.`id` = :id;");

      // Bind Values
        Database::getInstance()->bind(':id', $data['id']);
        Database::getInstance()->bind(':tit', $data['title']);
        Database::getInstance()->bind(':con', $data['content']);
        Database::getInstance()->bind(':src', $data['source']);
      
      //Execute
        if (Database::getInstance()->execute()) {
        return true;
      } else {
        return false;
      }
    }

    // Delete Post
    public function deleteArticle($data)
    {
      // Prepare Query
          Database::getInstance()->query('DELETE FROM `articles` WHERE id = :id');

      // Bind Values
          Database::getInstance()->bind(':id', $data['id']);
      
      //Execute
          if (Database::getInstance()->execute()) {
        return true;
      } else {
        return false;
      }
    }
  }


