<?php
require("./controllers/base-controller.php");
class CreateController extends BaseController
{
    public function main()
    {
        require("./views/create.view.php");
    }
}
