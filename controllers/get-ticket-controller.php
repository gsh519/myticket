<?php
require("./controllers/base-controller.php");
// require("./entities/ticket.php");
// require("./entities/question.php");
class GetTicketController extends BaseController
{
    public $ticket = null;

    public function main()
    {
        // チケット画像取得
        if ($_GET['ticket_key']) {
            $ticket_key = $_GET['ticket_key'];
            $get_ticket_param = [];
            $get_ticket_param[':ticket_key'] = $ticket_key;
            $get_ticket_sql = "SELECT * FROM ticket LEFT JOIN image ON ticket.ticket_img = image.id WHERE ticket_key = :ticket_key";
            $get_ticket_stmt = $this->db->prepare($get_ticket_sql);
            $get_ticket_stmt->execute($get_ticket_param);
            $this->ticket = $get_ticket_stmt->fetch(PDO::FETCH_ASSOC);
        }
        require('./views/get_ticket.view.php');

        // ダウンロードボタン押されたら
        if (isset($_POST['download'])) {
            //画像のパスとファイル名
            $fpath = 'localhost:8888/' . $this->ticket['image_path'];
            $fname = 'ticket_img';

            //画像のダウンロード
            header('Content-Type: application/octet-stream');
            header('Content-Length: ' . filesize($fpath));
            header('Content-disposition: attachment; filename="' . $fname . '"');
            readfile($fpath);
        }
    }
}
