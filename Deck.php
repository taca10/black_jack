<?php
class Deck
{
    public $trump = [];
    private $faces = [2,3,4,5,6,7,8,9,10,'J','Q','K','A'];
    private $marks = ["ダイヤ", "ハート", "スペード", "クラブ"];

    public function __construct() {
        foreach ($this->marks as $mark) {
          foreach ($this->faces as $face) {
            $this->trump[] = $mark . 'の' . $face;
          }
        }
    }

    public function shuffle() {
        shuffle($this->trump);
        return $this->trump;
    }

    public function drawCard() {
        $current = current($this->trump);
        if (!$current) {
            echo "カードがありません";
        }
        next($this->trump);
        return $current;
    }
}
