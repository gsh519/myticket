<?php
require("./entities/ticket.php");
require("./controllers/base-controller.php");

class TicketController extends BaseController
{
    public function main()
    {
        require('./views/ticketid_form.view.php');
    }
}
