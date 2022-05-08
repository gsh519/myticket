<?php
if (isset($_SERVER['DB_NAME']) && isset($_SERVER['HOSTNAME']) && isset($_SERVER['USERNAME']) && isset($_SERVER['PASSWORD'])) {
    define('DSN', 'mysql:charset=UTF8;dbname=' . $_SERVER['DB_NAME'] . ';host=' . $_SERVER['HOSTNAME']);
    define('USERNAME', $_SERVER['USERNAME']);
    define('PASSWORD', $_SERVER['PASSWORD']);
}

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
            if (isset($_SERVER['DB_NAME']) && isset($_SERVER['HOSTNAME']) && isset($_SERVER['USERNAME']) && isset($_SERVER['PASSWORD'])) {
                $this->db = new PDO(DSN, USERNAME, PASSWORD, $option);
            } else {
                $this->db = new PDO("mysql:charset=UTF8;dbname=myticket;host=localhost", "root", "root", $option);
            }
            // "mysql:charset=UTF8;dbname=myticket;host=localhost", "root", "root"
            // $this->db = new PDO(DSN, USERNAME, PASSWORD, $option);
        } catch (PDOException $e) {
            die('error' . $e->getMessage());
        }
    }

    public function escape($res)
    {
        $res = htmlspecialchars($res, ENT_QUOTES);
        echo $res;
    }
}
