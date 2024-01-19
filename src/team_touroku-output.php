<?php require "db-connect.php" ?>
<?php require "head.php" ?>

<?php
    $pdo = new PDO($connect, USER, PASS);
        $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = $pdo->prepare('select * from team where team_name=?');
        $sql->execute([$_POST['team_name']]);
        if (empty($sql->fetchAll())) {
            $sql = $pdo->prepare('INSERT INTO team (team_name,team_home,team_owner,team_pass) VALUES (?,?,?,?)');
            $sql->execute([
                $_POST['team_name'],
                $_POST['team_home'],
                $_POST['team_owner'],
                $pass
               
            ]);
            echo '<center>';
            echo 'お客様情報を登録しました';
            echo '<meta http-equiv="refresh" content="10;url=login-input.php">';
            echo '10秒後に<a href="login-input.php">ログイン画面</a>へ戻ります';
            echo '</center>';
        } else {
            echo '<center>';
            echo '入力エラーがあります';
            echo '<meta http-equiv="refresh" content="10;url=touroku-output.php">';
            echo '10秒後に<a href="touroku-input.php">新規チーム登録画面</a>へ戻ります';
            echo '</center>'; 
        }
?>