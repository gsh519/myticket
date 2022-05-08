<?php
class Ticket
{
    public $ticket_key = null;
    public $ticket_comment = null;
    public $image_name = null;
    public $image_content = null;
    public $image_size = null;
    public $errors;

    public function __construct(array $data = [], array $file = [])
    {
        if (isset($file['ticket_img'])) {
            $errors = [];
            $this->image_name = basename($file['ticket_img']['name']);
            $this->image_tmp_name = $file['ticket_img']['tmp_name'];
            $this->image_error = $file['ticket_img']['error'];
            $this->image_size = $file['ticket_img']['size'];

            // ファイルサイズ
            if ($this->image_size > 10485760 || $this->image_error == 2) {
                $errors[] = 'ファイルサイズは1MB未満にしてください';
            }

            // 拡張は画像形式化
            $allow_ext = ['jpeg', 'jpg', 'png'];
            $file_ext = pathinfo($this->image_name, PATHINFO_EXTENSION);
            if (!in_array(strtolower($file_ext), $allow_ext)) {
                $errors[] = '画像ファイルをアップロードしてください';
            }

            // ファイルはあるかどうか
            if (!is_uploaded_file($this->image_tmp_name)) {
                $errors[] = 'ファイルが選択されていません';
            }

            $this->errors = $errors;
        }
        if (isset($data['ticket_comment']) && $data['ticket_comment'] !== '') {
            $this->ticket_comment = $data['ticket_comment'];
        }

        // チケットIDの作成
        function generatePassword($length = 8)
        {
            $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $count = mb_strlen($chars);

            for (
                $i = 0, $result = '';
                $i < $length;
                $i++
            ) {
                $index = rand(0, $count - 1);
                $result .= mb_substr($chars, $index, 1);
            }

            return $result;
        }
        $this->ticket_key = generatePassword(8);
    }
}
