<?php
require("./controllers/base-controller.php");
require("./entities/user.php");
require("./entities/ticket.php");
require("./entities/question.php");
class ArchiveTicketController extends BaseController
{
    public $tickets = [];
    public function main()
    {
        // ログインしているユーザーのチケット一覧を取得する
        if (isset($_SESSION['login'])) {
            $current_user = $_SESSION['login'];
            $get_user = [];
            $get_user[':username'] = $current_user;
            $get_user_sql = "SELECT * FROM user LEFT JOIN user_ticket ON user.id = user_ticket.user_id WHERE username = :username";
            $get_user_stmt = $this->db->prepare($get_user_sql);
            $get_user_stmt->execute($get_user);
            $tickets = $get_user_stmt->fetchAll(PDO::FETCH_ASSOC);
            // var_dump($tickets);
            // die;

            foreach ($tickets as $ticket) {
                // var_dump($ticket);
                // die;
                $get_ticket = [];
                $get_ticket[':id'] = $ticket['ticket_id'];
                $get_ticket_sql = "SELECT * FROM ticket as t LEFT JOIN image ON image.id = t.ticket_img WHERE t.id = :id";
                $get_ticket_stmt = $this->db->prepare($get_ticket_sql);
                $get_ticket_stmt->execute($get_ticket);
                $this->tickets[] = $get_ticket_stmt->fetch(PDO::FETCH_ASSOC);
            }

            // var_dump($this->tickets);
            // die;
        }
        // var_dump($_SESSION);
        require("./views/archive_ticket.view.php");
    }
}
