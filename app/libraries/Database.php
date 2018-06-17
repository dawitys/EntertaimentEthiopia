<?php
	/* 
   *  PDO DATABASE CLASS
   *  Connects Database Using PDO
	 *  Creates Prepeared Statements
	 * 	Binds params to values
	 *  Returns rows and results
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