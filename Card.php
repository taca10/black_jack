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
}
