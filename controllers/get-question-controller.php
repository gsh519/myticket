<?php
require('./entities/ticket.php');
require('./entities/question.php');
require('./controllers/base-controller.php');

class GetQuestionController extends BaseController
{
    public $is_true;
    public $percent;
    public $comment;
    public $ticket_link;

    public function main()
    {
        $ticket = new Ticket();
        $question = new Question();
        $user_answers = [];
        $ticket->ticket_key = $_GET['ticket_key'];

        // ユーザーの回答をセット
        if ($_POST) {
            $user_answers[] = $_POST;
        }

        $select_param = [];

        if (!empty($ticket->ticket_key)) {
            $select_param[':ticket_key'] = $ticket->ticket_key;
            $select_sql = "SELECT * FROM question WHERE ticket_key = :ticket_key";
            $select_stmt = $this->db->prepare($select_sql);
            $select_stmt->execute($select_param);
            $question->questions = $select_stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!$question->questions) {
                $this->errors[] = '質問を取得できませんでした';
            }

            // 正しい回答をセット
            foreach ($question->questions as $value) {
                $question->answers[] = $value['answer'];
            }

            if ($user_answers) {
                // 回答をチェック
                $is_true = $question->checkAnswer($user_answers);
                $percent = $question->changePercent($user_answers);
                $comment = $question->changeComment($user_answers);
                $ticket_link = $question->showLink($user_answers);
            }
        } else {
            $this->errors[] = 'チケットIDを取得できません';
        }

        require('./views/question.view.php');
    }
}
