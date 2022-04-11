<?php
require("./controllers/base-controller.php");
require("./entities/ticket.php");
require("./entities/question.php");
class CreatedTicketController extends BaseController
{
    public $ticket;
    public $questions;

    public function main()
    {
        if ($_GET['ticket_key']) {
            $ticket_key = $_GET['ticket_key'];

            // チケット情報取得
            $get_ticket_param = [];
            $get_ticket_param[':ticket_key'] = $ticket_key;
            $get_ticket_sql = "SELECT * FROM ticket WHERE ticket_key = :ticket_key";
            $get_ticket_stmt = $this->db->prepare($get_ticket_sql);
            $get_ticket_stmt->execute($get_ticket_param);
            $this->ticket = $get_ticket_stmt->fetch();

            // クイズ情報取得
            $get_question_param = [];
            $get_question_param[':ticket_key'] = $ticket_key;
            $get_question_sql = "SELECT * FROM question WHERE ticket_key = :ticket_key";
            $get_question_stmt = $this->db->prepare($get_question_sql);
            $get_question_stmt->execute($get_question_param);
            $this->questions = $get_question_stmt->fetchAll(PDO::FETCH_ASSOC);
        }


        require("./views/created_ticket.view.php");
    }
}
