<?php 
    session_start(); 
    ob_start();

    require "db-connect.php";
    require "head.php";

    
    try {
        $pdo = new PDO($connect, USER, PASS);

        // playerテーブルに選手情報を挿入
        $playerInsertQuery = $pdo->prepare('INSERT INTO player (player_name, team_id, player_number, position_id, home_id, player_salary, player_year) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $playerInsertQuery->bindParam(1, $_SESSION['form']['player_name'], PDO::PARAM_STR);
        $playerInsertQuery->bindParam(2, $_SESSION['form']['team_id'], PDO::PARAM_INT);
        $playerInsertQuery->bindParam(3, $_SESSION['form']['number'], PDO::PARAM_INT);
        $playerInsertQuery->bindParam(4, $_SESSION['form']['position'], PDO::PARAM_INT);
        $playerInsertQuery->bindParam(5, $_SESSION['form']['home'], PDO::PARAM_INT);
        $playerInsertQuery->bindParam(6, $_SESSION['form']['salary'], PDO::PARAM_INT);
        $playerInsertQuery->bindParam(7, $_SESSION['form']['year'], PDO::PARAM_INT);
        $playerInsertQuery->execute();

        // 直近に挿入されたplayerテーブルのIDを取得
        $lastPlayerId = $pdo->lastInsertId();

        if ($_SESSION['form']['position'] == 1) {
            // 投手の場合、pitcherテーブルに成績情報を挿入
            $pitcherInsertQuery = $pdo->prepare('INSERT INTO pitcher_recode (player_id, toubansuu, ining, win, lose, jiseki, datusansin, sisikyu, hold, save) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $pitcherInsertQuery->bindParam(1, $lastPlayerId, PDO::PARAM_INT);
            $pitcherInsertQuery->bindParam(2, $_POST['toubansuu'], PDO::PARAM_INT);
            $pitcherInsertQuery->bindParam(3, $_POST['ining'], PDO::PARAM_INT);
            $pitcherInsertQuery->bindParam(4, $_POST['win'], PDO::PARAM_INT);
            $pitcherInsertQuery->bindParam(5, $_POST['lose'], PDO::PARAM_INT);
            $pitcherInsertQuery->bindParam(6, $_POST['jiseki'], PDO::PARAM_INT);
            $pitcherInsertQuery->bindParam(7, $_POST['datusansin'], PDO::PARAM_INT);
            $pitcherInsertQuery->bindParam(8, $_POST['sisikyu'], PDO::PARAM_INT);
            $pitcherInsertQuery->bindParam(9, $_POST['hold'], PDO::PARAM_INT);
            $pitcherInsertQuery->bindParam(10, $_POST['save'], PDO::PARAM_INT);
            $pitcherInsertQuery->execute();
        } else {
            // 打者の場合、batterテーブルに成績情報を挿入
            $batterInsertQuery = $pdo->prepare('INSERT INTO batter_recode (player_id, daseki, anda, two, three, hr, daten, tokuten, tourui,sisikyu, gida,gifu, sansin,error) VALUES (?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?)');
            $batterInsertQuery->bindParam(1, $lastPlayerId, PDO::PARAM_INT);
            $batterInsertQuery->bindParam(2, $_POST['daseki'], PDO::PARAM_INT);
            $batterInsertQuery->bindParam(3, $_POST['anda'], PDO::PARAM_INT);
            $batterInsertQuery->bindParam(4, $_POST['two'], PDO::PARAM_INT);
            $batterInsertQuery->bindParam(5, $_POST['three'], PDO::PARAM_INT);
            $batterInsertQuery->bindParam(6, $_POST['hr'], PDO::PARAM_INT);
            $batterInsertQuery->bindParam(7, $_POST['daten'], PDO::PARAM_INT);
            $batterInsertQuery->bindParam(8, $_POST['tokuten'], PDO::PARAM_INT);
            $batterInsertQuery->bindParam(9, $_POST['tourui'], PDO::PARAM_INT);
            $batterInsertQuery->bindParam(10, $_POST['sisikyu'], PDO::PARAM_INT);
            $batterInsertQuery->bindParam(11, $_POST['gida'], PDO::PARAM_INT);
            $batterInsertQuery->bindParam(12, $_POST['gifu'], PDO::PARAM_INT);
            $batterInsertQuery->bindParam(13, $_POST['sansin'], PDO::PARAM_INT);
            $batterInsertQuery->bindParam(14, $_POST['error'], PDO::PARAM_INT);
            $batterInsertQuery->execute();
        }

        // 成功したらトップページにリダイレクト
        header('Location: https://aso2201219.noor.jp/php2/final/top.php');
        exit();
    } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
    }

    ob_end_flush();
?>
