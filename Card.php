<?php
class Card
{
    public $player;
    public $dealer;

    public $playerPoints = 0;
    public $dealerPoints = 0;

    public function __construct($player, $dealer) {
        $this->player = $player;
        $this->dealer = $dealer;
    }

    public function getScore(string $hand) {
        if($hand == "player") {
            switch(end($this->player->hand)) {
                case strpos(end($this->player->hand), "J") !== false:
                    $this->playerPoints += 10;
                    break;
                case strpos(end($this->player->hand), "Q") !== false:
                    $this->playerPoints += 10;
                    break;
                case strpos(end($this->player->hand), "K") !== false:
                    $this->playerPoints += 10;
                    break;
                case strpos(end($this->player->hand), "A") !== false:
                    $this->playerPoints += 1;
                    break;
                default:
                    $this->playerPoints += intval(preg_replace('/[^0-9]/', '', end($this->player->hand)));
            }
        }

        if($hand == "dealer") {
            switch(end($this->dealer->hand)) {
                case strpos(end($this->dealer->hand), "J") !== false:
                    $this->dealerPoints += 10;
                    break;
                case strpos(end($this->dealer->hand), "Q") !== false:
                    $this->dealerPoints += 10;
                    break;
                case strpos(end($this->dealer->hand), "K") !== false:
                    $this->dealerPoints += 10;
                    break;
                case strpos(end($this->dealer->hand), "A") !== false:
                    $this->dealerPoints += 1;
                    break;
                default:
                    $this->dealerPoints += intval(preg_replace('/[^0-9]/', '', end($this->dealer->hand)));
            }
        }
    }
}

