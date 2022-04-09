<?php
require("./controllers/base-controller.php");
require("./entities/ticket.php");
class CreatedTicketController extends BaseController
{
    public function main()
    {
        require("./views/created_ticket.view.php");
    }
}
