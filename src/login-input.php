<?php session_start(); ?>
<?php require "db-connect.php" ?>
<?php require "head.php" ?>

<center>
    <h2>ログイン</h2> 

    <form action ="login-output.php" method="post">
        <p><input type= text name="team_name" placeholder="チーム名を入力"></p>
        <p><input type="password" name="password" placeholder="パスワードを入力"></p> 
        
        <input type="submit" value="ログイン">
    </form>

    <br>
    <a href="touroku-input.php">チーム登録の方はこちらから</a>
    
</body>
</html>