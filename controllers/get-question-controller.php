<?php
require('./entities/ticket.php');
require('./entities/question.php');
require('./controllers/base-controller.php');

class GetQuestionController extends BaseController
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

            // var_dump($ticket_data);
            // die;

            if ($ticket_data) {
                var_dump($ticket_data);
            } else {
                header("Location ./ticket_form.php");
                exit;
            }
        }





        // $question = new Question();
        // $user_answers = [];
        // $ticket->ticket_id = $_GET['ticket_id'];

        // // ユーザーの回答をセット
        // if ($_POST) {
        //     $user_answers[] = $_POST;
        // }


        // if (!empty($ticket->ticket_id)) {
        //     $pdo = dbConnect("myticket", "localhost", "root", "root");
        //     $sql = "SELECT * FROM question WHERE ticket_id = :ticket_id";
        //     $stmt = $pdo->prepare($sql);
        //     $stmt->bindParam(":ticket_id", $ticket->ticket_id, PDO::PARAM_STR);
        //     $stmt->execute();
        //     $question->questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //     if (!$question->questions) {
        //         $errors[] = '質問を取得できませんでした';
        //     }

        //     // 正しい回答をセット
        //     foreach ($question->questions as $value) {
        //         $question->answers[] = $value['answer'];
        //     }

        //     if ($user_answers) {
        //         // 回答をチェック
        //         $is_true = $question->checkAnswer($user_answers);
        //         $percent = $question->changePercent($user_answers);
        //         $comment = $question->changeComment($user_answers);
        //         $ticket_link = $question->showLink($user_answers);
        //         // $ticket_page = $question->ticketPage($user_answers);
        //     }

        //     // var_dump($ticket_page);
        //     // die;
        // } else {
        //     $errors[] = 'チケットIDを取得できません';
        // }

        require('./views/get_question.view.php');
    }
}
