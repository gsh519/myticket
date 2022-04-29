<?php
class IndexController
{
    public function main()
    {
        session_start();
        var_dump($_SESSION);
        require('./views/index.view.php');
    }
}
