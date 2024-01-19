<?php
session_start();
require "db-connect.php";
require "head.php";
?>


<center>
    <form action="player_edit-output.php" method="post">
        <?php
    
    

    $_SESSION['form'] = [
        'player_name' => $_POST['player_name'],
        'team_id' => $_SESSION['team']['team_id'],
        'number' => $_POST['number'],
        'position' => $_POST['position'],
        'home' => $_POST['home'],
        'salary' => $_POST['salary'],
        'year' => $_POST['year'],
    ];
    
        
        $commonFields = '
            <p>打席数</p><input type="number" name="daseki">
            <p>安打</p><input type="number" name="anda">
            <p>二塁打</p><input type="number" name="two">
            <p>三塁打</p><input type="number" name="three">
            <p>HR</p><input type="number" name="hr">
            <p>打点</p><input type="number" name="daten">
            <p>得点</p><input type="number" name="tokuten">
            <p>盗塁</p><input type="number" name="tourui">
            <p>四死球</p><input type="number" name="sisikyu">
            <p>犠打</p><input type="number" name="gida">
            <p>犠飛</p><input type="number" name="gifu">
            <p>三振</p><input type="number" name="sansin">
            <p>エラー</p><input type="number" name="error">
        ';

        if ($_POST['position'] == 1) {
            echo '<h1>投手成績登録</h1>
            <p>登板数</p><input type="number" name="toubansuu">
            <p>投球回</p><input type="number" name="ining">
            <p>勝利数</p><input type="number" name="win">
            <p>敗戦数</p><input type="number" name="lose">
            <p>自責点</p><input type="number" name="jiseki">
            <p>奪三振数</p><input type="number" name="datusansin">
            <p>与四死球</p><input type="number" name="sisikyu">
            <p>ホールド数</p><input type="number" name="hold">
            <p>セーブ数</p><input type="number" name="save">';
        } else {
            echo '<h1>打者成績登録</h1>' . $commonFields;
        }
        
        ?>

        <p><input type="submit" value="登録"></p>
    </form>
</center>

<?php
// ここに追加の処理を記述する
?>
</body>
</html>
