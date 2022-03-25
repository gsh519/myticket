<?php
abstract class BaseController
{
    public $db;
    public $errors = [];

    public function __construct()
    {
        session_start();

        // データーベースに接続
        try {
            $option = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
            ];
            $this->db = new PDO("mysql:charset=UTF8;dbname=myticket;host=localhost", "root", "root", $option);
        } catch (PDOException $e) {
            die('error' . $e->getMessage());
        }
    }

    public function escape($res)
    {
        $res = htmlspecialchars($res, ENT_QUOTES);
        return $res;
    }
}
