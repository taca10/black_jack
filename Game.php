<?php

class Game
{

    public $deck;
    public $player;
    public $dealer;
    public $card;

    public function __construct($deck, $player, $dealer, $card) {
        $this->deck = $deck;
        $this->player = $player;
        $this->dealer = $dealer;
        $this->card = $card;
    }

    public function start()
    {
        $this->player->hand[] = $this->deck->drawCard();
        $this->card->getScore('player');
        $this->player->hand[] = $this->deck->drawCard();
        $this->card->getScore('player');
        $this->dealer->hand[] = $this->deck->drawCard();
        $this->card->getScore('dealer');
        $this->dealer->hand[] = $this->deck->drawCard();
        $this->card->getScore('dealer');

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
    }

    public function nextStart($card) {
        echo "カードを引きますか？引く場合はYを引かない場合はNを入力してください\n";
        $stdin = trim(fgets(STDIN));
        if ($stdin == "Y") {
            $this->player->hand[] = $this->deck->drawCard();
            $card->getScore("player");
            echo "あなたの引いたカードは" . end($this->player->hand) . "です\n";
            if($card->playerPoints >= 21 ) {
                echo "バーストしました。あなたの負けです\n";
                return;
            }
            $this->nextStart($card);
        }elseif($stdin == "N"){
            while($card->dealerPoints < 17) {
              $this->dealer->hand[] = $this->deck->drawCard();
              $card->getScore("dealer");
            }
            $this->result($card);
        }else{
            echo "YかNを入力してください\n";
        }
    }

    function result($card) {
        echo "ディーラーの２枚目のカードは". $this->dealer->hand[1] . "でした。\n";
        echo "ディーラーの得点は". $card->dealerPoints . "です。\n";
        echo "あなたの得点は" . $card->playerPoints . "です\n";
        $this->judgement($card);
    }

    function judgement($card) {
        if ($card->playerPoints > $card->dealerPoints) {
            echo "あなたの勝ちです\n";
            return;
        }
        if($card->dealerPoints > 21) {
            echo "ディーラーがバーストしました\n";
            echo "あたたの勝ちです\n";
            return;
        }
        if($card->playerPoints < $card->dealerPoints) {
            echo "ディーラーの勝ちです\n";
            return;
        }
        if($card->playerPoints == $card->dealerPoints) {
            echo "引き分けです\n";
            return;
        }
    }
}
