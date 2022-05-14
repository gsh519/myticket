<?php
require("./controllers/base-controller.php");

class IndexController extends BaseController
{
    public function main()
    {
        require('./views/index.view.php');
    }
}
