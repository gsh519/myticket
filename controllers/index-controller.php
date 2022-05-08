<?php
class IndexController
{
    public function main()
    {
        session_start();
        require('./views/index.view.php');
    }
}
