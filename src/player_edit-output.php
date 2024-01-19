<?php 
   
    ob_start();
    session_start(); 

    require "db-connect.php";
    require "head.php";

    try {
        $pdo = new PDO($connect, USER, PASS);

        // playerテーブルに選手情報を更新
        $playerUpdateQuery = $pdo->prepare('UPDATE player SET player_name = ?, team_id = ?, player_number = ?, position_id = ?, home_id = ?, player_salary = ?, player_year = ? WHERE player_id = ?');
        $playerUpdateQuery->bindParam(1, $_SESSION['form']['player_name'], PDO::PARAM_STR);
        $playerUpdateQuery->bindParam(2, $_SESSION['form']['team_id'], PDO::PARAM_INT);
        $playerUpdateQuery->bindParam(3, $_SESSION['form']['number'], PDO::PARAM_INT);
        $playerUpdateQuery->bindParam(4, $_SESSION['form']['position'], PDO::PARAM_INT);
        $playerUpdateQuery->bindParam(5, $_SESSION['form']['home'], PDO::PARAM_INT);
        $playerUpdateQuery->bindParam(6, $_SESSION['form']['salary'], PDO::PARAM_INT);
        $playerUpdateQuery->bindParam(7, $_SESSION['form']['year'], PDO::PARAM_INT);
        $playerUpdateQuery->bindParam(8, $_SESSION['player_id'], PDO::PARAM_INT); // 追加

        $playerUpdateQuery->execute();

        // ポジションによって処理を分ける
        if ($_SESSION['form']['position'] == 1) {
            // 投手の場合、pitcherテーブルに成績情報を更新
            $pitcherUpdateQuery = $pdo->prepare('UPDATE pitcher_recode SET toubansuu=?, ining=?, win=?, lose=?, jiseki=?, datusansin=?, sisikyu=?, hold=?, save=? WHERE player_id = ?');
            $pitcherUpdateQuery->bindParam(1, $_POST['toubansuu'], PDO::PARAM_INT);
            $pitcherUpdateQuery->bindParam(2, $_POST['ining'], PDO::PARAM_INT);
            $pitcherUpdateQuery->bindParam(3, $_POST['win'], PDO::PARAM_INT);
            $pitcherUpdateQuery->bindParam(4, $_POST['lose'], PDO::PARAM_INT);
            $pitcherUpdateQuery->bindParam(5, $_POST['jiseki'], PDO::PARAM_INT);
            $pitcherUpdateQuery->bindParam(6, $_POST['datusansin'], PDO::PARAM_INT);
            $pitcherUpdateQuery->bindParam(7, $_POST['sisikyu'], PDO::PARAM_INT);
            $pitcherUpdateQuery->bindParam(8, $_POST['hold'], PDO::PARAM_INT);
            $pitcherUpdateQuery->bindParam(9, $_POST['save'], PDO::PARAM_INT);
            $pitcherUpdateQuery->bindParam(10, $_SESSION['player_id'], PDO::PARAM_INT);

            $pitcherUpdateQuery->execute();
        } else {
            // 打者の場合、batterテーブルに成績情報を更新
            $batterUpdateQuery = $pdo->prepare('UPDATE batter_recode SET daseki=?, anda=?, two=?, three=?, hr=?, daten=?, tokuten=?, tourui=?, sisikyu=?, gida=?, gifu=?, sansin=?, error=? WHERE player_id = ?');
            $batterUpdateQuery->bindParam(1, $_POST['daseki'], PDO::PARAM_INT);
            $batterUpdateQuery->bindParam(2, $_POST['anda'], PDO::PARAM_INT);
            $batterUpdateQuery->bindParam(3, $_POST['two'], PDO::PARAM_INT);
            $batterUpdateQuery->bindParam(4, $_POST['three'], PDO::PARAM_INT);
            $batterUpdateQuery->bindParam(5, $_POST['hr'], PDO::PARAM_INT);
            $batterUpdateQuery->bindParam(6, $_POST['daten'], PDO::PARAM_INT);
            $batterUpdateQuery->bindParam(7, $_POST['tokuten'], PDO::PARAM_INT);
            $batterUpdateQuery->bindParam(8, $_POST['tourui'], PDO::PARAM_INT);
            $batterUpdateQuery->bindParam(9, $_POST['sisikyu'], PDO::PARAM_INT);
            $batterUpdateQuery->bindParam(10, $_POST['gida'], PDO::PARAM_INT);
            $batterUpdateQuery->bindParam(11, $_POST['gifu'], PDO::PARAM_INT);
            $batterUpdateQuery->bindParam(12, $_POST['sansin'], PDO::PARAM_INT);
            $batterUpdateQuery->bindParam(13, $_POST['error'], PDO::PARAM_INT);
            $batterUpdateQuery->bindParam(14, $_SESSION['player_id'], PDO::PARAM_INT);

            $batterUpdateQuery->execute();
        }

        // 成功したらトップページにリダイレクト
        header('Location: https://aso2201219.noor.jp/php2/final/top.php');
        exit();
    } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
    }

    ob_end_flush();
?>
