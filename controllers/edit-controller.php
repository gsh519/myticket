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
            $upload_dir = 'upload_images/';
            $save_image_name = date('YmdHis') . $new_ticket->image_name;
            $save_path = $upload_dir . $save_image_name;
            move_uploaded_file($new_ticket->image_tmp_name, $save_path);

            // DBに保存
            $this->db->beginTransaction();
            try {
                // 画像を更新する処理
                $update_image = [];
                if ($new_ticket->image_name === '' && is_null($new_ticket->image_content)) {
                    $update_image[':image_name'] = $this->ticket['image_name'];
                    $update_image[':image_path'] = $this->ticket['image_path'];
                } else {
                    $update_image[':image_name'] = $new_ticket->image_name;
                    $update_image[':image_path'] = $save_path;
                }
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

                // クエスチョン情報を更新する処理
                foreach ($new_questions->questions as $i => $question) {
                    $update_question = [];
                    $update_question[':id'] = $this->questions[$i]['id'];
                    $update_question[':subject'] = $question['subject'];
                    $update_question[':answer_list1'] = $question['answer_list1'];
                    $update_question[':answer_list2'] = $question['answer_list2'];
                    $update_question[':answer_list3'] = $question['answer_list3'];
                    $update_question[':answer'] = $question['answer'];
                    $update_question_sql = "UPDATE question SET subject = :subject, answer_list1 = :answer_list1, answer_list2 = :answer_list2, answer_list3 = :answer_list3, answer = :answer WHERE id = :id";
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

        // 削除ボタン押されたらすること
        // ファイルから画像削除 image_path
        // DBからその画像のデータ削除 id
        // チケットデータ削除 ticket_key or id
        if (isset($_POST['delete'])) {
            // ファイルから画像削除
            $delete_image = $this->ticket['image_path'];
            if (!unlink($delete_image)) {
                $this->errors[] = '画像が削除できませんでした';
            }

            $this->db->beginTransaction();

            try {
                // DBからその画像のデータ削除 id
                $delete_param = [];
                $delete_param[':id'] = $this->ticket['ticket_img'];
                $delete_sql = "DELETE FROM image WHERE id = :id";
                $delete_stmt = $this->db->prepare($delete_sql);
                $delete_stmt->execute($delete_param);

                // チケットデータ削除 ticket_key or id
                $delete_ticket = [];
                $delete_ticket[':ticket_key'] = $this->ticket['ticket_key'];

                $delete_ticket_sql = "DELETE FROM ticket WHERE ticket_key = :ticket_key";
                $delete_ticket_stmt = $this->db->prepare($delete_ticket_sql);
                $delete_ticket_stmt->execute($delete_ticket);

                $delete_question_sql = "DELETE FROM question WHERE ticket_key = :ticket_key";
                $delete_question_stmt = $this->db->prepare($delete_question_sql);
                $delete_question_stmt->execute($delete_ticket);

                $res = $this->db->commit();
                if ($res) {
                    $_SESSION['msg'] = 'チケットが削除できました';
                    header("Location: ./");
                    exit;
                }
            } catch (Exception $e) {
                $this->db->rollBack();
                $this->errors[] = '削除できませんでした';
            }
        }

        require('./views/edit.view.php');
    }
}
