<?php
session_start();
ob_start(); 
require "head.php";
require "db-connect.php";

?>

<body>
    <?php
    unset($_SESSION['team']);

    
    $pdo = new PDO($connect, USER, PASS);
    $sql = $pdo->prepare('select * from team where team_name=?');
    $sql->execute([$_POST['team_name']]);
    foreach ($sql as $row) {
        
        // echo $row['team_name'],'<br>';
        echo $_POST['password'],'<br>';
        echo password_hash($_POST['password'], PASSWORD_DEFAULT);
        echo '<br>';
        // echo $row['team_pass'];
      
        if (password_verify($_POST['password'], $row['team_pass']) ) {
            echo 'true';
        }else{
            echo 'false';
        }

        if (password_verify($_POST['password'], $row['team_pass']) ) {
            $_SESSION['team'] = [
                'team_id' => $row['team_id'],
                'team_name' => $row['team_name'],
                'team_home' => $row['team_home'],
                'team_owner' => $row['team_owner'],
                'team_pass' => $row['team_pass']
                

            ];
        }
    }
    if (isset($_SESSION['team'])) {
        $redirect_url = 'https://aso2201219.noor.jp/php2/final/top.php';
        header('Location: ' . $redirect_url);
        exit();
    } else {
        echo '<center>';
        echo '<br>';
        echo '<h2>チーム名又はパスワードが誤っています。</h2>';
        echo '<a href="login-input.php" ><span class="login">ログイン画面へ</span></a>';
    
        echo '</center>';
        // echo '<meta http-equiv="refresh" content="5;url=login.php">';
        
    }

    ob_end_flush(); // バッファの内容を送信
    ?>
</body>
</html>