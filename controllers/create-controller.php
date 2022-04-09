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
            $questions = new Question($_POST['questions']);

            $add_ticket = [];
            $add_ticket[':ticket_key'] = $ticket->ticket_key;
            $add_ticket[':ticket_img'] = $ticket->ticket_img;
            $add_ticket[':ticket_comment'] = $ticket->ticket_comment;

            $this->db->beginTransaction();

            try {
                // チケット情報を追加する処理
                $add_sql = "INSERT INTO ticket (ticket_key, ticket_img, ticket_comment) VALUES (:ticket_key, :ticket_img, :ticket_comment)";
                $add_stmt = $this->db->prepare($add_sql);
                $add_stmt->execute($add_ticket);

                // クエスチョン情報を追加する処理
                foreach ($questions->questions as $question) {
                    $add_question = [];
                    $add_question[':ticket_key'] = $ticket->ticket_key;
                    $add_question[':subject'] = $question['subject'];
                    $add_question[':answer_list1'] = $question['answer_list1'];
                    $add_question[':answer_list2'] = $question['answer_list2'];
                    $add_question[':answer_list3'] = $question['answer_list3'];
                    $add_question[':answer'] = $question['answer'];

                    $add_question_sql = "INSERT INTO question (ticket_key, subject, answer_list1, answer_list2, answer_list3, answer) VALUES (:ticket_key, :subject, :answer_list1, :answer_list2, :answer_list3, :answer)";
                    $add_question_stmt = $this->db->prepare($add_question_sql);
                    $add_question_stmt->execute($add_question);
                }

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
