<?php
class Image
{
    public $db;
    public function exportImage($id)
    {
        $content_type = [
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
        ];

        // データーベースに接続
        try {
            $option = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
            ];
            $this->db = new PDO("mysql:charset=UTF8;dbname=myticket;host=localhost", "root", "root", $option);
        } catch (PDOException $e) {
            die('error' . $e->getMessage());
        }
        $param = [];
        $param[':id'] = $id;
        $sql = "select * from image where id = :id limit 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($param);
        $image = $stmt->fetch(PDO::FETCH_ASSOC);

        header('Content-type: image/jpeg');
        echo base64_encode($image['image_content']);
        exit();
    }
}
