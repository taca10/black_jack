<?php
class Card
{
    public $player;
    public $dealer;

    public $userPoints = 0;
    public $dealerPoints = 0;

    public function __construct($player, $dealer) {
        $this->player = $player;
        $this->dealer = $dealer;
    }

    public function getScore() {
        // playerhandかdealerhand userPontsかdealerPoints
        
        foreach($this->player->hand as $playerHand) {
            switch($playerHand) {
                case strpos($playerHand, "J") !== false:
                    $this->userPoints += 10;
                    echo "j";
                    break;
                case strpos($playerHand, "Q") !== false:
                    $this->userPoints += 10;
                    echo "Q";
                    break;
                case strpos($playerHand, "K") !== false:
                    $this->userPoints += 10;
                    echo "K";
                    break;
                case strpos($playerHand, "A") !== false:
                    $this->userPoints += 1;
                    echo "A";
                    break;
                default:
                    $this->userPoints += intval(preg_replace('/[^0-9]/', '', $playerHand));
            }
        }

        foreach($this->dealer->hand as $dealerHand) {
            switch($dealerHand) {
                case strpos($dealerHand, "J") !== false:
                    $this->dealerPoints += 10;
                    echo "j";
                    break;
                case strpos($dealerHand, "Q") !== false:
                    $this->dealerPoints += 10;
                    echo "Q";
                    break;
                case strpos($dealerHand, "K") !== false:
                    $this->dealerPoints += 10;
                    echo "K";
                    break;
                case strpos($dealerHand, "A") !== false:
                    $this->dealerPoints += 1;
                    echo "A";
                    break;
                default:
                    $this->dealerPoints += intval(preg_replace('/[^0-9]/', '', $dealerHand));
            }
        }
    }
}

