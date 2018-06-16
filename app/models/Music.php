<?php

/**
 * Created by PhpStorm.
 * User: MY
 * Date: 6/16/2018
 * Time: 12:26 AM
 */
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

include('Entertaimentproduct.php');

class Music extends EntertaimentProduct
{
    public $singer;
    public $producer;

    public function __construct($id, $title, $singer, $len, $date, $producer, $rate = 1, $reviews = [])
    {
        $this->id = $id;
        $this->title = $title;
        $this->singer = $singer;
        $this->length = $len;
        $this->releaseDate = $date;
        $this->producer = $producer;
        $this->rate = $rate;
        $this->reviews = $reviews;
    }

    public function updateRate($data)
    {
    }

    public function getRate()
    {
        // TODO: Implement getRate() method.
    }

    public function addReview($data)
    {
        // TODO: Implement addReview() method.
    }

    public function getReviews($data)
    {
        // TODO: Implement getReviews() method.
    }

    public static function getAllProducts()
    {
        $list = [];
        Database::getInstance()->query("SELECT * FROM `musics` ORDER BY `release_date` DESC;");
        $results = Database::getInstance()->resultset();
        foreach ($results as $music) {
            $list[] = new Music($music->id, $music->music_title, $music->singer, $music->length,
                $music->release_date, $music->producer);
        }
        return $list;

    }

    public function getRecentProducts()
    {
        // TODO: Implement getRecentProducts() method.
    }

    public function addProduct($data)
    {
        // TODO: Implement addProduct() method.
    }
}
/*
$ms=Music::getAllProducts();
    foreach ($ms as $mus){
        echo $mus->title;
    }
*/