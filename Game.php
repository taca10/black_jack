<?php

class Game
{

  public $deck;
  public $player;
  public $dealer;

  public function __construct($deck, $player, $dealer) {
    $this->deck = $deck;
    $this->player = $player;
    $this->dealer = $dealer;
  }

  public function start()
  {
    $this->player->hand[] = $this->deck->drawCard();
    $this->player->hand[] = $this->deck->drawCard();
    $this->dealer->hand[] = $this->deck->drawCard();
    $this->dealer->hand[] = $this->deck->drawCard();

    foreach ($this->player->hand as $hands) {
      echo "あなたの引いたカードは" . $hands . "です\n";
    }

    for($i=0; $i<count($this->dealer->hand); $i++) {
      if($i == 0) {
        echo "ディーラーの引いたカードは" . $this->dealer->hand[$i] . "です\n";
      }
      if($i == 1) {
        echo "ディーラーの引いたカードはわかりません\n";
      }
    }

    // $messages = [];
    // $messages[] = "あなたの引いたカードは" . $deck->drawCard() . "です\n";
    // $messages[] = "あなたの引いたカードは" . $deck->drawCard() . "です\n";
    // $messages[] = "ディーラーの引いたカードは" . $deck->drawCard() . "です\n";
    // $messages[] = "ディーラーの２枚目のカードはわかりません\n";
    // printf("あなたの引いたカードは" . $deck->drawCard() . "です");

    // $this->dealerCard[] = $deck->drawCard();
    // return $messages;
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
      return "あなたの勝ちです";
    }
    if($this->dealerPoints >= 21) {
      return "あたたの勝ちです";
    }
    if($this->userPoints < $this->dealerPoints) {
      return "ディーラーの勝ちです";
    }
    if($this->userPoints == $this->dealerPoints) {
      echo "引き分けです";
    }
  }
}
