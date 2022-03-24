<?php
class Question
{
    public $subject = null;
    public $questions = [];
    public $answers = [];
    private $is_true = [];
    private $comment;
    private $percent;
    private $judgement;

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

    public function changePercent(array $data = [])
    {
        $count = 0;
        $all_count = count($this->questions);
        foreach ($this->answers as $index => $answer) {
            if ($data[0]['answer' . $index] === $answer) {
                $count++;
            }
        }

        if ($count === $all_count) {
            $this->percent = '全問正解！！';
        } else {
            $this->percent = $all_count . '問中' . $count . '問正解';
        }

        return $this->percent;
    }

    public function changeComment(array $data = [])
    {
        $count = 0;
        $all_count = count($this->questions);
        foreach ($this->answers as $index => $answer) {
            if ($data[0]['answer' . $index] === $answer) {
                $count++;
            }
        }

        if ($count / $all_count >= 0.7) {
            $this->comment = 'おめでとうございます！<br>チケットを受け取ることができます！！';
        } else {
            $this->comment = '残念！チケットを受け取ることができません';
        }

        return $this->comment;
    }

    public function showLink(array $data = [])
    {
        $count = 0;
        $all_count = count($this->questions);
        foreach ($this->answers as $index => $answer) {
            if ($data[0]['answer' . $index] === $answer) {
                $count++;
            }
        }

        if ($count / $all_count >= 0.7) {
            return true;
        } else {
            return false;
        }
    }
}
