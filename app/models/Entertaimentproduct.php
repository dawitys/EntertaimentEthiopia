<?php

abstract class EntertaimentProduct
{
    public $id;
    public $title;
    public $length;
    public $releaseDate;
    public $producer;
    protected $rate;
    protected $reviews;

//    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    abstract public function updateRate($data);

    abstract public function getRate();

    abstract public function addReview($data);

    abstract public function getReviews($data);

    abstract public static function getAllProducts();

    abstract public function getRecentProducts();

    abstract public function addProduct($data);

}
