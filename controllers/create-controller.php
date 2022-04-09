<?php
require("./controllers/base-controller.php");
require("./entities/ticket.php");
require("./entities/question.php");
class CreateController extends BaseController
{
    public function main()
    {
        if (!empty($_POST['create'])) {
            $ticket = new Ticket($_POST, $_FILES);
            // $questions = new Question($_POST['subject'], $_POST['answers']);

            $add_ticket = [];
            $add_ticket[':ticket_key'] = $ticket->ticket_key;
            $add_ticket[':ticket_img'] = $ticket->ticket_img;
            $add_ticket[':ticket_comment'] = $ticket->ticket_comment;

            $add_questions = [];
            $add_questions[':subject'] =

                $this->db->beginTransaction();

            try {
                // チケット情報を追加する処理
                $add_sql = "INSERT INTO ticket (ticket_key, ticket_img, ticket_comment) VALUES (:ticket_key, :ticket_img, :ticket_comment)";
                $add_stmt = $this->db->prepare($add_sql);
                $add_stmt->execute($add_ticket);

                // クエスチョン情報を追加する処理

                $res = $this->db->commit();

                if ($res) {
                    $_SESSION['msg'] = 'チケットが作成できました';
                    header("Location: ./created_ticket.php");
                    exit;
                }
            } catch (Exception $e) {
                $this->db->rollBack();
                echo 'チケットが作成できませんでした:' . $e;
                return false;
            }
        }
        require("./views/create.view.php");
    }
}
