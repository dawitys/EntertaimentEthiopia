<?php

/**
 * Created by PhpStorm.
 * User: MY
 * Date: 6/16/2018
 * Time: 3:29 PM
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

class MovieSchedule
{
    public $movieName;
    public $schedules;

    public function __construct($movieName = null, $schedules = [])
    {
        $this->movieName = $movieName;
        $this->schedules = $schedules;
    }

    public function loadSchedule($movie, $day, $time)
    {
        $this->schedules[] = [$movie, $day, $time];
    }

    public function getScheduleByMovie($data)
    {
        Database::getInstance()->query("SELECT cinemas.name as n,movies.movie_title as m, movie_schedules.schedule_day as d,movie_schedules.schedule_time as t FROM cinemas,movies,movie_schedules WHERE movies.movie_title = :tit AND movie_schedules.cinema_id=cinemas.id");
        Database::getInstance()->bind(':tit', $data['title']);

        $row = Database::getInstance()->resultset();

        foreach ($row as $movieSchedule) {
            $this->loadSchedule($movieSchedule->n, $movieSchedule->d, $movieSchedule->t);
//            echo $movieSchedule->n.'<br>'.$movieSchedule->m.'<br>'.$movieSchedule->d.'<br>'.$movieSchedule->t.'<br><br>';
        }
        return $this->schedules;
    }

    public function getScheduleByCinema($data)
    {
        Database::getInstance()->query("SELECT*FROM cinemas,movies,movie_schedules WHERE cinemas.name = :tit AND cinemas.id=movie_schedules.cinema_id AND movies.id=movie_schedules.movie_id;");
        Database::getInstance()->bind(':tit', $data['name']);

        $row = Database::getInstance()->resultset();

        foreach ($row as $movieSchedule) {
            echo $data['name'] . '<br>' . $movieSchedule->movie_title . '<br>' . $movieSchedule->schedule_day . '<br>' . $movieSchedule->schedule_time . '<br><br>';
        }
    }

}
/*
$ms=new MovieSchedule();
$ms->getScheduleByMovie(['title'=>"sfg"]);
foreach ($ms->schedules as $sch){
    echo $sch[0].'<br>'.$sch[1].'<br>'.$sch[2].'<br>';
}
*/