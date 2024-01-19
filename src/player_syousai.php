<?php session_start(); ?>
<?php require "db-connect.php"; ?>
<?php require "head.php"; ?>


<?php


$pdo = new PDO($connect, USER, PASS);
if($_GET['position_id']==1){
    $sql = $pdo->prepare('SELECT player.*, pitcher_recode.* FROM player LEFT JOIN pitcher_recode ON player.player_id = pitcher_recode.player_id WHERE player.player_id = ?');
}else{
    $sql = $pdo->prepare('SELECT player.*, batter_recode.* FROM player LEFT JOIN batter_recode ON player.player_id = batter_recode.player_id  WHERE player.player_id = ?');
}


if (isset($_GET['player_id'])) {
    $_SESSION['player_id']=$_GET['player_id'];
    $sql->execute([$_GET['player_id']]);
} else {
    $sql->execute([$_SESSION['player_id']]);
}


    if($_GET['position_id']==1){
        echo '<table>';
        echo '<tbody>';
        echo '<tr>';
        echo '<th>', '防御率', '</th>';
        echo '<th>', '登板', '</th>';
        echo '<th>', '投球回', '</th>';
        echo '<th>', '勝利', '</th>';
        echo '<th>', '敗戦', '</th>';
        echo '<th>', '勝率', '</th>';
        echo '<th>', '奪三振', '</th>';
        echo '<th>', '奪三振率', '</th>';
        echo '<th>', '自責点', '</th>';
        echo '</tr>';
    
        foreach ($sql as $row) {
            
            echo '<h1>', $row['player_number'], '　', $row['player_name'], '</h1>';
            echo '<tr>';
            $pitchingAverage = ($row['ining'] > 0) ? ($row['jiseki'] * 9 / $row['ining']) : 0;
            echo '<td>', number_format($pitchingAverage, 3), '</td>';
            


            echo '<td>', $row['toubansuu'], '</td>';
            echo '<td>', $row['ining'], '</td>';
            echo '<td>', $row['win'], '</td>';
            echo '<td>', $row['lose'], '</td>';
            $denominator = $row['win'] + $row['lose'];
            $win = ($denominator > 0) ? ($row['win'] / $denominator) : 0;
            echo '<td>', number_format($win, 3), '</td>';
            
            echo '<td>', $row['datusansin'], '</td>';
            $denominatorDatusansin = $row['ining'];
            $datusansin = ($denominatorDatusansin > 0) ? (($row['datusansin'] * 9) / $denominatorDatusansin) : 0;
            echo '<td>', number_format($datusansin, 3), '</td>';

            echo '<td>', $row['jiseki'], '</td>';
            
            echo '</tr>';
            echo '<a href="player_edit1-input.php?player_id=', $row['player_id'], '">','編集', '</a>';
            echo '<a href="p_delete.php?player_id=', $row['player_id'], '">','削除', '</a>';
        }
    
        echo '</tbody>';
        echo '</table>';
    
    }else{
        echo '<table>';
        echo '<tbody>';
        echo '<tr>';
        echo '<th>', '打率', '</th>';
        echo '<th>', '打席', '</th>';
        echo '<th>', '打数', '</th>';
        echo '<th>', '安打', '</th>';
        echo '<th>', '２塁打', '</th>';
        echo '<th>', '３塁打', '</th>';
        echo '<th>', 'HR', '</th>';
        echo '<th>', '長打率', '</th>';
        echo '<th>', '盗塁', '</th>';
        echo '<th>', '四死球', '</th>';
        echo '<th>', '三振', '</th>';
        echo '<th>', '出塁率', '</th>';
        echo '<th>', 'ops', '</th>';
        echo '<th>', 'エラー', '</th>';
        echo '</tr>';
    
        foreach ($sql as $row) {
          
            echo '<h1>', $row['player_number'], '　', $row['player_name'], '</h1>';
            echo '<tr>';
            $denominatorBattingAverage = $row['daseki'] - $row['sisikyu'] + $row['gida'] + $row['gifu'];
            $battingAverage = ($denominatorBattingAverage > 0) ? ($row['anda'] / $denominatorBattingAverage) : 0;
            echo '<td>', number_format($battingAverage, 3), '</td>';


            echo '<td>', $row['daseki'], '</td>';

            $denominatorDasuu = $row['daseki'] - $row['sisikyu'] + $row['gida'] + $row['gifu'];
            $dasuu = ($denominatorDasuu > 0) ? ($row['daseki'] - ($row['sisikyu'] + $row['gida'] + $row['gifu'])) : 0;
            echo '<td>', $dasuu, '</td>';

            echo '<td>', $row['anda'], '</td>';
            echo '<td>', $row['two'], '</td>';
            echo '<td>', $row['three'], '</td>';
            echo '<td>', $row['hr'], '</td>';
            $denominatorTyo = $denominatorDasuu ?: 1; 
            $tyo = ((($row['anda'] - $row['two'] + $row['three'] + $row['hr']) + $row['two'] + $row['three'] + $row['hr']) / $denominatorTyo) ?: 0;
            echo '<td>', number_format($tyo, 3), '</td>';
            
            echo '<td>', $row['tourui'], '</td>';
            echo '<td>', $row['sisikyu'], '</td>';
            echo '<td>', $row['sansin'], '</td>';
            $denominatorSyu = ($dasuu + $row['sisikyu'] + $row['gifu']) ?: 1; 
            $syu = (($row['anda'] + $row['sisikyu']) / $denominatorSyu) ?: 0;
            echo '<td>', number_format($syu, 3), '</td>';
            
            $denominatorOps = ($dasuu + $row['sisikyu'] + $row['gifu']) ?: 1; 
            $ops = $tyo + $syu;
            echo '<td>', number_format($ops, 3), '</td>';
            

            echo '<td>', $row['error'], '</td>';
            echo '</tr>';
            echo '<a href="player_edit1-input.php?player_id=', $row['player_id'], '">','編集', '</a>';
            echo '<br>';
            echo '<a href="b_delete.php?player_id=', $row['player_id'], '">','削除', '</a>';
        }
    
        echo '</tbody>';
        echo '</table>'; 
    }


?>

</body>
</html>
