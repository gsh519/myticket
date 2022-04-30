<?php
require("./controllers/base-controller.php");
require("./entities/ticket.php");
require("./entities/question.php");
class CreateController extends BaseController
{
    public function main()
    {
        if (isset($_POST['create'])) {
            $ticket = new Ticket($_POST, $_FILES);
            $questions = new Question($_POST['questions']);

            if (empty($ticket->errors)) {
                // ファイルに画像を保存
                $upload_dir = 'upload_images/';
                $save_image_name = date('YmdHis') . $ticket->image_name;
                $save_path = $upload_dir . $save_image_name;
                move_uploaded_file($ticket->image_tmp_name, $save_path);

                // DBに保存
                $this->db->beginTransaction();
                try {
                    // まずはuser情報を取得
                    $get_user = [];
                    $get_user['username'] = $_SESSION['login'];
                    $get_user_sql = "SELECT * FROM user WHERE username = :username";
                    $get_user_stmt = $this->db->prepare($get_user_sql);
                    $get_user_stmt->execute($get_user);
                    $user = $get_user_stmt->fetch(PDO::FETCH_ASSOC);

                    // 画像を保存する処理
                    $add_image = [];
                    $add_image[':image_name'] = $ticket->image_name;
                    $add_image[':image_path'] = $save_path;

                    $image_sql = "INSERT INTO image (image_name, image_path) VALUES (:image_name, :image_path)";
                    $image_stmt = $this->db->prepare($image_sql);
                    $image_stmt->execute($add_image);

                    // 追加した画像のidを取得する
                    $select_sql = "SELECT id FROM image ORDER BY id DESC LIMIT 1";
                    $select_stmt = $this->db->prepare($select_sql);
                    $select_stmt->execute();
                    $image_id = $select_stmt->fetch(PDO::FETCH_ASSOC);

                    // チケット情報を追加する処理
                    $add_ticket = [];
                    $add_ticket[':ticket_key'] = $ticket->ticket_key;
                    $add_ticket[':ticket_img'] = $image_id['id'];
                    $add_ticket[':ticket_comment'] = $ticket->ticket_comment;

                    $add_sql = "INSERT INTO ticket (ticket_key, ticket_img, ticket_comment) VALUES (:ticket_key, :ticket_img, :ticket_comment)";
                    $add_stmt = $this->db->prepare($add_sql);
                    $add_stmt->execute($add_ticket);

                    // 追加したチケット情報追加
                    $get_ticket = [];
                    $get_ticket['ticket_key'] = $ticket->ticket_key;
                    $get_ticket_sql = "SELECT id FROM ticket WHERE ticket_key = :ticket_key";
                    $get_ticket_stmt = $this->db->prepare($get_ticket_sql);
                    $get_ticket_stmt->execute($get_ticket);
                    $ticket_id = $get_ticket_stmt->fetch(PDO::FETCH_ASSOC);

                    $add_data = [];
                    $add_data[':user_id'] = $user['id'];
                    $add_data[':ticket_id'] = $ticket_id['id'];
                    $add_sql = "INSERT INTO user_ticket (user_id, ticket_id) VALUES (:user_id, :ticket_id)";
                    $add_stmt = $this->db->prepare($add_sql);
                    $add_stmt->execute($add_data);

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
                        header("Location: ./created_ticket.php?ticket_key={$ticket->ticket_key}");
                        exit;
                    }
                } catch (Exception $e) {
                    $this->db->rollBack();
                    echo 'チケットが作成できませんでした:' . $e;
                }
            }
        } else {
            $ticket = new Ticket();
            $questions = new Question();
        }
        require("./views/create.view.php");
    }
}
