<?php


class Model
{
    public $db = null;
    const HOST = 'localhost';
    const USER = 'root';
    const PASS = '';
    const DB = 'data_car';

    public function connect(){
        $this->db = mysqli_connect(self::HOST,self::USER, self::PASS, self::DB) or die(mysqli_error());
        mysqli_set_charset($this->db, "utf8mb4");

        mysqli_select_db($this->db, self::DB) or die("Cannot select DB");
        return $this->db;
    }

	// метод выборки данных
//	public function get_data()
//	{
//		// todo
//	}
}