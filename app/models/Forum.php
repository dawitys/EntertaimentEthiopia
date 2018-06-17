<?php

class Forum
{
    public $id;
    public $title;
    public $catagory;
    private $thoughts;

    public function __construct($id = null, $title = null, $catagory = null, $thoughts = [])
    {
        $this->id = $id;
        $this->title = $title;
        $this->catagory = $catagory;
        $this->thoughts = [];
    }

    // add a thought to a forum
    public function addThought($data)
    {
        //implementation based on database..
        // foreach ($participant as )
        // $this.$this->thoughts[$participant]=$comment;
    }

    public function loadThoughts()
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

}

    // Update a Forum
public
function updateForum($data)
{
        // Prepare Query
        Database::getInstance()->query("UPDATE `forums` SET `title` = ':title' WHERE `forums`.`id` = :id;");

        // Bind Values
        Database::getInstance()->bind(':id', $data['id']);
        Database::getInstance()->bind(':title', $data['title']);
        Database::getInstance()->bind(':body', $data['body']);

        //Execute
        if (Database::getInstance()->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Get list of all available fourms
    public static function getAllForums()
    {
        Database::getInstance()->query("SELECT * FROM `forums`;");
        $results = Database::getInstance()->resultset();
      return $results;
    }

    //get list of  fourms with limited number
public
static function getRecentForums($data = ['limit' => 10])
    {
        Database::getInstance()->query("SELECT * FROM `forums` ORDER BY `date` DESC LIMIT :lim");
        Database::getInstance()->bind(':lim', $data['limit']);
        $results = Database::getInstance()->resultset();
      return $results;
    }

// Get Post By title
    public static function getForum($data)
    {
        Database::getInstance()->query("SELECT * FROM `forums` WHERE title = :title");
        Database::getInstance()->bind(':title', $data['title']);
        $row = Database::getInstance()->single();
      return $row;
    }

}

$a = Forum::getAllForums();
foreach ($a as $i) {
    echo $i->title . '<br>';
}
