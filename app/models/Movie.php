<?php
/**
 * Created by PhpStorm.
 * User: MY
 * Date: 6/16/2018
 * Time: 12:26 AM
 */

include('Entertaimentproduct.php');

class Movie extends EntertaimentProduct
{
    public $cast;
    public $director;

    public function __construct()
    {

    }

    public function updateRate($data)
    {
        //code...
    }

    public function getRate()
    {
        //code..
    }

    public function addReview($data)
    {
        // code..
    }

    public function getReviews($data)
    {
        // code..
    }

    public static function getAllProducts()
    {
        $list = [];
        Database::getInstance()->query("SELECT * FROM `movies` ORDER BY `release_date` DESC;");
        $results = Database::getInstance()->resultset();
        foreach ($results as $movie) {
            $list[] = new Music($movie->id, $movie->title, $movie->singer, $movie->length,
                $movie->release_date, $movie->producer);
        }
        return $list;
    }

    public static function getRecentProducts($data = ['limit' => 3])
    {
        $list = [];
        Database::getInstance()->query("SELECT * FROM `movies` ORDER BY `release_date` DESC LIMIT :lim;");
        Database::getInstance()->bind(':lim', $data['limit']);
        $results = Database::getInstance()->resultset();
        foreach ($results as $movie) {
            $list[] = new Music($movie->id, $movie->title, $movie->singer, $movie->length,
                $movie->release_date, $movie->producer);
        }
        return $list;
    }

    public function postProduct($data)
    {
        // Prepare Query
        Database::getInstance()->query("INSERT INTO `movies`( `movie_title`, `length`, `release_date`, `producer`, `cast`) VALUES (:title, :len, NOW(), :producer, :cast);");

        // Bind Values
        Database::getInstance()->bind(':title', $data['title']);
        Database::getInstance()->bind(':len', $data['length']);
//        Database::getInstance()->bind(':date', $data['date']);
        Database::getInstance()->bind(':producer', $data['producer']);
        Database::getInstance()->bind(':cast', $data['cast']);

        //Execute
        if (Database::getInstance()->execute()) {
            return true;
        } else {
            return false;
        }
    }

}

//$t=new Movie();
//echo $t->postProduct(['title'=>"TEST FROm PHP222222",'producer'=>"Dawddfit Yonas",'cast'=>"Amf fsdhfss d ,f df,adfgfb",'length'=>65.00]);
