<?php
namespace App\Bitm\Model;

class Database{
    public $conn;
    public function __construct()
    {
        $this->conn=mysqli_connect("localhost","root","","neci") or die('Database connection failed');
    }


}