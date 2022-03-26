<?php
require("./entities/ticket.php");
require("./controllers/base-controller.php");

class TicketController extends BaseController
{
    public function main()
    {
        $ticket = new Ticket();

        //初期値
        if (!empty($_POST)) {
            $ticket->ticket_key = $_POST['ticket_key'];
            $submit = $_POST['submit'];
        }

        if (!empty($submit)) {
            if (empty($ticket->ticket_key)) {
                $this->errors[] = 'チケットIDを入力してください';
            }

            // データ取得
            $select_params = [];
            $select_params[':ticket_key'] = $ticket->ticket_key;
            $select_sql = "SELECT ticket_key FROM ticket WHERE ticket_key = :ticket_key";
            $select_stmt = $this->db->prepare($select_sql);
            $select_stmt->execute($select_params);
            $ticket_data = $select_stmt->fetch(PDO::FETCH_ASSOC);

            if ($ticket_data) {
                header("Location: ./question.php?ticket_key={$ticket->ticket_key}");
                exit;
            } elseif ($ticket_data === false) {
                $this->errors[] = 'チケットIDが違います';
            }
        }

        require('./views/ticketid_form.view.php');
    }
}
