<?php
require 'Deck.php';
require 'Game.php';

echo "ブラックジャッックへようこそ！！！" . PHP_EOL;
echo "ゲームを開始します。" . PHP_EOL;

$deck = new Deck();
$deck->shuffle();
$game = new Game($deck);
$messages = $game->start($deck);
foreach ($messages as $message) {
  echo $message;
}

$game->convertToScore($messages);
$game->nextStart();

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
