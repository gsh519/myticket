<?php
class Question
{
    public $subject = null;
    //質問
    public $questions = [];
    // 正しい回答
    public $answers = [];
    // 回答チェック
    public $is_true = [];
    // 回答文言
    public $comment;

    /**
     * 渡ってきた回答を正しい回答とチェックさせる
     * @param array $data
     * @return array
     */
    public function checkAnswer(array $data = []): array
    {
        foreach ($this->answers as $index => $answer) {
            if ($data[0]['answer' . $index] === $answer) {
                $this->is_true[$index] = '正解';
            } else {
                $this->is_true[$index] = '不正解';
            }
        }

        return $this->is_true;
    }

    // public function changeComment(array $data = [])
    // {
    // }
}
