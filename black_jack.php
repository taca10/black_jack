<?php
require 'Deck.php';
require 'Game.php';
require 'Player.php';
require 'Dealer.php';
require 'Card.php';

echo "ブラックジャッックへようこそ！！！" . PHP_EOL;
echo "ゲームを開始します。" . PHP_EOL;

// インスタンス名、メソッドをみて自然な文章(ゲーム)になっているか
$deck = new Deck();
$deck->shuffle();
$player = new Player();
$dealer = new Dealer();
$card = new Card($player, $dealer);
$game = new Game($deck, $player, $dealer, $card);
$game->start();
$game->nextStart($card);
