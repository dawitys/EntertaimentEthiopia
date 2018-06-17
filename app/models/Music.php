<?php
/**
 * Created by PhpStorm.
 * User: MY
 * Date: 6/16/2018
 * Time: 12:26 AM
 */

include('Entertaimentproduct.php');

class Music extends EntertaimentProduct
{
    public $singer;
    public $producer;

    public function __construct($id = null, $title = null, $singer = null, $len = null, $date = null, $producer = null, $rate = 1, $reviews = [])
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

    }

    public function addReview($data)
    {
        //code..
    }

    public function getReviews($data)
    {
        //code..
    }

    public static function getAllProducts()
    {
        $list = [];
        Database::getInstance()->query("SELECT * FROM `musics` ORDER BY `release_date` ASC;");
        $results = Database::getInstance()->resultset();
        foreach ($results as $music) {
            $list[] = new Music($music->id, $music->music_title, $music->singer, $music->length,
                $music->release_date, $music->producer);
        }
        return $list;
    }

    public static function getRecentProducts($data = ['limit' => 1])
    {
        $list = [];
        Database::getInstance()->query("SELECT * FROM `musics` ORDER BY `release_date` DESC LIMIT :lim;");
        Database::getInstance()->bind(':lim', $data['limit']);
        $results = Database::getInstance()->resultset();
        foreach ($results as $music) {
            $list[] = new Music($music->id, $music->music_title, $music->singer, $music->length,
                $music->release_date, $music->producer);
        }
        return $list;
    }

    public function postProduct($data)
    {
        // Prepare Query
        Database::getInstance()->query("INSERT INTO `musics`( `music_title`,`singer`, `length`, `release_date`, `producer`) VALUES (:title,:singer, :len, NOW(), :producer);");

        // Bind Values
        Database::getInstance()->bind(':title', $data['title']);
        Database::getInstance()->bind(':len', $data['length']);
//        Database::getInstance()->bind(':date', $data['date']);
        Database::getInstance()->bind(':producer', $data['producer']);
        Database::getInstance()->bind(':singer', $data['singer']);

        //Execute
        if (Database::getInstance()->execute()) {
            return true;
        } else {
            return false;
        }
    }

}
/*
$t=new Music();
echo $t->postProduct(['title'=>"TEST FROm PHP",'producer'=>"Dawit Yonas",'singer'=>"asdg",'length'=>4.00]);

$ms=Music::getRecentProducts();
foreach ($ms as $mus){
    echo $mus->title;
}
*/

