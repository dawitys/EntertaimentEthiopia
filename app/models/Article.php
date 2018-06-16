<?php

class Database
{
    private static $ins = null;

    private static $host = "localhost";
    private static $user = "root";
    private static $pass = "";
    private static $dbname = "entertaiment_ethiopia";

    private static $dbh;
    private $error;
    private $stmt;

    public static function getInstance()
    {
        if (self::$ins == null) {
            self::$ins = new Database;
        }
        return self::$ins;
    }

    public function __construct()
    {
        // Set DSN
        $dsn = 'mysql:host=' . self::$host . ';dbname=' . self::$dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        // Create a new PDO instanace
        try {
            self::$dbh = new PDO ($dsn, self::$user, self::$pass, $options);
        }        // Catch any errors
        catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }

    // Prepare statement with query
    public function query($query)
    {
        $this->stmt = self::$dbh->prepare($query);
    }

    // Bind values
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value) :
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value) :
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value) :
                    $type = PDO::PARAM_NULL;
                    break;
                default :
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // Execute the prepared statement
    public function execute()
    {
        return $this->stmt->execute();
    }

    // Get result set as array of objects
    public function resultset()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get single record as object
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Get record row count
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }

    // Returns the last inserted ID
    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }
}
  class Article {
      public $id;
      public $title;
      public $content;
      public $catagory;
      public $importance;
      public $releaseDate;
      public $source;

      // private static $db;

      public function __construct($id = null, $title = null, $content = null, $catagory = null, $importance = 1, $releaseDate = null, $source = null)
      {
          $this->id = $id;
          $this->title = $title;
          $this->content = $content;
          $this->catagory = $catagory;
          $this->importance = $importance;
          $this->releaseDate = $releaseDate;
          $this->source = $source;

//      Database::getInstance()= Database::getInstance();
//          echo "created Article";
      }

    // Get All Articles
      public static function getAllArticles()
      {
          $list = [];
          Database::getInstance()->query("SELECT * FROM `articles` ORDER BY `date` DESC;");
          $results = Database::getInstance()->resultset();
          foreach ($results as $article) {
              $list[] = new Article($article->id, $article->title, $article->content,
                  $article->catagory, $article->importance, $article->date, $article->source);
          }
          return $list;

    }

    // Get Post By ID
      public static function getArticle($data)
      {
          Database::getInstance()->query("SELECT * FROM `articles` WHERE title = :title");
          Database::getInstance()->bind(':title', $data['title']);
          $article = Database::getInstance()->single();

          return new Article($article->id, $article->title, $article->content,
              $article->catagory, $article->importance, $article->date, $article->source);
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

$a = Article::getAllArticles();
foreach ($a as $i) {
    echo $i->title . '<br>';
}

