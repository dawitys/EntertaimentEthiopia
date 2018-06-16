<?php

/**
 * Created by PhpStorm.
 * User: MY
 * Date: 6/15/2018
 * Time: 11:59 PM
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

class Cinema
{
    public $id;
    public $name;
    public $location;

//    private $db;

    public function __construct($id = null, $name = null, $loc = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->location = $loc;

//      $this->db = new Database;
    }

    // Get All Articles
    public static function getAllCinemas()
    {
        $list = [];
        Database::getInstance()->query("SELECT * FROM `cinemas`;");
        $results = Database::getInstance()->resultset();
        foreach ($results as $cinema) {
            $list[] = new Cinema($cinema->id, $cinema->name, $cinema->location);
        }
        return $list;

    }

    // Add Cinema / Register
    public function addCinema($data)
    {
        // Prepare Query
        Database::getInstance()->query('INSERT INTO cinemas (name,location) VALUES(:name, :location)');

        // Bind Values
        Database::getInstance()->bind(':name', $data['name']);
        Database::getInstance()->bind(':location', $data['location']);

        //Execute
        if (Database::getInstance()->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Find cinema by name
    public function getCinemaByName($data)
    {
        Database::getInstance()->query("SELECT * FROM cinemas WHERE cinemas.name = :name");
        Database::getInstance()->bind(':name', $data['name']);

        $row = Database::getInstance()->single();

        //Check Rows
        if (Database::getInstance()->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Find cinema by ID
    public function getCinemaById($data)
    {
        Database::getInstance()->query("SELECT * FROM cinemas WHERE id = :id");
        Database::getInstance()->bind(':id', $data['id']);

        $row = Database::getInstance()->single();

        return $row;
    }

}
/*
$cl=Cinema::getAllCinemas();
foreach ($cl as $cin){
    echo $cin->name.'<br>';
}
*/