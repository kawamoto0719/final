<?php
session_start();

// セッションを削除
if(isset($_SESSION['team'])){
    unset($_SESSION['team']);
    
}
// リダイレクト先のURLを設定
$redirect_url = 'https://aso2201219.noor.jp/php2/final/login-input.php';

// リダイレクト
header('Location: ' . $redirect_url);
exit();
?>

