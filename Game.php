<?php

class Game
{
public $userPoints = 0;
public $dealerPoints = 0;
public $dealerCard = array();

  public function start($deck)
  {
    $messages = [];
    $messages[] = "あなたの引いたカードは" . $deck->drawCard() . "です\n";
    $messages[] = "あなたの引いたカードは" . $deck->drawCard() . "です\n";
    $messages[] = "ディーラーの引いたカードは" . $deck->drawCard() . "です\n";
    $messages[] = "ディーラーの２枚目のカードはわかりません\n";

    $this->dealerCard[] = $deck->drawCard();
    return $messages;
  }

  function convertToScore($messages) {
    for ($i=0; $i<count($messages); $i++) {
      $points = $this->convertFaceToNumber($messages, $i);
      if ($i < 2){
        $this->userPoints += intval(preg_replace('/[^0-9]/', '', $messages[$i]));
        $this->userPoints += $points;
      }else {
        $this->dealerPoints += intval(preg_replace('/[^0-9]/', '', $messages[$i]));
        $this->dealerPoints += $points;
      }
      if (count($messages) == 1) {
        echo "あなたの現在の得点は" . $this->userPoints . "です\n";
        return;
      }
    }
    if(preg_replace('/[^0-9]/', '', $this->dealerCard[0]) == "") {
      $this->dealerPoints += 10;
    }else {
      $this->dealerPoints += intval(preg_replace('/[^0-9]/', '', $this->dealerCard[0]));
    }
    echo "あなたの現在の得点は" . $this->userPoints . "です\n";
  }

  function convertFaceToNumber($messages, $i) {
    $points = 0;
    if(strpos($messages[$i], 'J')) {
      $points += 10;
    }elseif(strpos($messages[$i], 'Q')) {
      $points += 10;
    }elseif(strpos($messages[$i], 'K')) {
      $points += 10;
    }elseif(strpos($messages[$i], 'A')) {
      $points += 1;
    }
    return $points;
  }

  function nextStart() {
    $messages = [];
    echo "カードを引きますか？引く場合はYを引かない場合はNを入力してください\n";
    $stdin = trim(fgets(STDIN));
    $deck = new Deck(); 
    if ($stdin == "N") {
      $this->result();
    }elseif ($stdin == "Y") {
      $deck = new Deck(); 
      $deck->shuffle();
      $messages[] = "あなたの引いたカードは" . $deck->drawCard() . "です\n";
      // $this->dealerCard[] = $deck->drawCard();
      $this->convertToScore($messages);
      if($this->userPoints >= 21) {
        echo "バーストしました。あなたの負けです";
        return;
      }
      $this->nextStart($deck);
    }else {
      echo "YかNを入力してください\n";
      $this->nextStart();
    }
  }

  function result() {
    echo "ディーラーの２枚目のカードは". $this->dealerCard[0] . "でした。";
    echo "ディーラーの得点は". $this->dealerPoints . "です。";
    echo "あなた得点は" . $this->userPoints . "です";
    $this->judgement();
  }

  function judgement() {
    if ($this->userPoints > $this->dealerPoints) {
      echo "あなたの勝ちです";
    }else if($this->dealerPoints >= 21) {
      echo "あたたの勝ちです";
    }else if($this->userPoints < $this->dealerPoints) {
      echo "ディーラーの勝ちです";
    }else {
      echo "引き分けです";
    }
  }
}
