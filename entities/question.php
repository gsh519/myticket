<?php
class Question
{
    public $subject = null;
    // 正しい回答
    public $answers = [];
    // 回答チェック
    public $is_true = [];

    public function checkAnswer($data = [])
    {
        foreach ($this->answers as $index => $answer) {
            if ($data[0]['answer' . $index] === $answer) {
                $this->is_true[] = 'true';
            } else {
                $this->is_true[] = 'false';
            }
        }

        return $this->is_true;
    }
}
