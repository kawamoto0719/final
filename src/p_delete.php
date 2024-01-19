<?php
session_start();
require "db-connect.php"; // データベース接続設定ファイルの読み込み

try {
    $pdo = new PDO($connect, USER, PASS); // PDOオブジェクトの作成


    $deletePlayerQuery1 = $pdo->prepare('DELETE FROM pitcher_recode WHERE player_id = ?');
    $deletePlayerQuery1->bindParam(1, $_GET['player_id'], PDO::PARAM_INT); // GETパラメーターからplayer_idを取得

    // 選手情報を削除
    $deletePlayerQuery1->execute();
    // プレースホルダーを使用してSQL文を準備
    $deletePlayerQuery = $pdo->prepare('DELETE FROM player WHERE player_id = ?');
    $deletePlayerQuery->bindParam(1, $_GET['player_id'], PDO::PARAM_INT); // GETパラメーターからplayer_idを取得

    // 選手情報を削除
    $deletePlayerQuery->execute();

    // 成功したらトップページにリダイレクト
    header('Location: https://aso2201219.noor.jp/php2/final/top.php');
    exit();
} catch (PDOException $e) {
    echo "エラー: " . $e->getMessage();
}
?>