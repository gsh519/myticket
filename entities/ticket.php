<?php
class Ticket
{
    public $ticket_key = null;
    public $ticket_img = null;
    public $ticket_comment = null;

    public function __construct(array $data = [], array $file = [])
    {
        if (isset($file['ticket_img'])) {
            $this->ticket_img = file_get_contents($file['ticket_img']['tmp_name']);
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
