<?php
require("./controllers/base-controller.php");
require("./entities/ticket.php");
require("./entities/question.php");
class EditController extends BaseController
{
    public $ticket;
    public $questions;

    public function main()
    {
        // チケット・クイズ情報表示
        if ($_GET['ticket_key']) {
            $ticket_key = $_GET['ticket_key'];

            // チケット情報取得
            $get_ticket_param = [];
            $get_ticket_param[':ticket_key'] = $ticket_key;
            $get_ticket_sql = "SELECT * FROM ticket LEFT JOIN image ON ticket.ticket_img = image.id WHERE ticket_key = :ticket_key";
            $get_ticket_stmt = $this->db->prepare($get_ticket_sql);
            $get_ticket_stmt->execute($get_ticket_param);
            $this->ticket = $get_ticket_stmt->fetch(PDO::FETCH_ASSOC);

            // クイズ情報取得
            $get_question_param = [];
            $get_question_param[':ticket_key'] = $ticket_key;
            $get_question_sql = "SELECT * FROM question WHERE ticket_key = :ticket_key";
            $get_question_stmt = $this->db->prepare($get_question_sql);
            $get_question_stmt->execute($get_question_param);
            $this->questions = $get_question_stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // 編集ボタン押されたら
        if (isset($_POST['edit'])) {
            // 新しく投稿されたデータをセット
            $new_ticket = new Ticket($_POST, $_FILES);
            $new_questions = new Question($_POST['questions']);
            // ファイルに画像を保存
            $upload_dir = 'upload_images/';
            $save_image_name = date('YmdHis') . $new_ticket->image_name;
            $save_path = $upload_dir . $save_image_name;
            move_uploaded_file($new_ticket->image_tmp_name, $save_path);

            // DBに保存
            $this->db->beginTransaction();
            // rjY9lDTb
            try {
                // DBに保存する内容
                // 画像データ
                // チケットのコメント
                // クイズデータ
                // var_dump($this->ticket);
                // die;

                // 画像を更新する処理
                $update_image = [];
                $update_image[':image_name'] = $new_ticket->image_name;
                $update_image[':image_path'] = $save_path;
                $update_image[':id'] = $this->ticket['ticket_img'];
                $image_sql = "UPDATE image SET image_name = :image_name, image_path = :image_path WHERE id = :id";
                $image_stmt = $this->db->prepare($image_sql);
                $image_stmt->execute($update_image);

                // チケット情報を更新する処理
                $update_ticket = [];
                $update_ticket[':ticket_img'] = $this->ticket['ticket_img'];
                $update_ticket[':ticket_comment'] = $new_ticket->ticket_comment;
                $update_sql = "UPDATE ticket SET ticket_comment = :ticket_comment WHERE ticket_img = :ticket_img";
                $update_stmt = $this->db->prepare($update_sql);
                $update_stmt->execute($update_ticket);

                // var_dump($this->ticket);
                // die;

                // クエスチョン情報を更新する処理
                foreach ($new_questions->questions as $question) {
                    $update_question = [];
                    $update_question[':ticket_key'] = $this->ticket['ticket_key'];
                    $update_question[':subject'] = $question['subject'];
                    $update_question[':answer_list1'] = $question['answer_list1'];
                    $update_question[':answer_list2'] = $question['answer_list2'];
                    $update_question[':answer_list3'] = $question['answer_list3'];
                    $update_question[':answer'] = $question['answer'];
                    $update_question_sql = "UPDATE question SET subject = :subject, answer_list1 = :answer_list1, answer_list2 = :answer_list2, answer_list3 = :answer_list3, answer = :answer WHERE ticket_key = :ticket_key";
                    $update_question_stmt = $this->db->prepare($update_question_sql);
                    $update_question_stmt->execute($update_question);
                }

                $res = $this->db->commit();

                if ($res) {
                    $_SESSION['msg'] = 'チケットが編集できました';
                    header("Location: ./created_ticket.php?ticket_key={$this->ticket['ticket_key']}");
                    exit;
                }
            } catch (Exception $e) {
                $this->db->rollBack();
                echo 'チケットが編集できませんでした:' . $e;
            }
        }

        require('./views/edit.view.php');
    }
}
