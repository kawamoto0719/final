<?php require "db-connect.php" ?>
<?php require "head.php" ?>

<form action="team_touroku-output.php"  method="post">

<center>
<h2>新規チーム登録<h2>
    <p>チーム名</p>
    <input type="text" name="team_name">
    <p>パスワード</p>
    <input type="password" name="password">
    <p>チーム本拠地</p>
    <input type="text" name="team_home">
    <p>チームオーナー</p>
    <input type="text" name="team_owner">

    <p><input type="submit" value="登録">
</center>
</body>
</html>
