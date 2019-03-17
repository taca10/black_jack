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
// player, dealer,deck, をgameに渡す
$game = new Game($deck, $player, $dealer);
$game->start();

$card = new Card($player, $dealer);

// $player = new Player();

// messages返すのは微妙そう。。。。
// // class内に閉じ込める
// foreach ($messages as $message) {
//   echo $message;
// }

// // カードクラスを作って、点数、絵札を管理 convartToScore謎すぎる。getscoreとかにする
// $game->convertToScore($messages);
// $game->nextStart();

// 登場人物
// ユーザー
// 自分の持ち札を管理する


// フィールド
// 得点を計算

// カード
// カード情報を管理
// カードの絵柄で何点かを確認

// 山札
// 山札からカードを引く枚数を管理

// ゲーム
// 点数を管理
