<?php session_start(); ?>
<?php require "db-connect.php" ?>
<?php require "head.php" ?>

<div class="main-content">
    <?php require "header.php" ?>
    <div class="container">
        <div class="sidebar">
            <h3><?php echo $_SESSION['team']['team_owner']; ?> さん、ようこそ</h3>
            <ul>
                <li><a href="player_touroku-input.php">●新規選手登録</a></li>
                
                <li>
                    <div onclick="obj=document.getElementById('open').style; obj.display=(obj.display=='none')?'block':'none';">
                        <a style="cursor:pointer;">▼個人成績ランキング</a>
                    </div>
                    <!-- 折り畳まれ部分 -->
                    <div id="open" style="display:none;clear:both;">
                        <ul>
                            <li><a href="#">・投手成績(未実装)</a></li>
                            <li><a href="#">・打者成績(未実装)</a></li>
                        </ul>
                    </div>
                </li>
                <li><a href="logout.php">●ログアウト</a></li>
            </ul>
        </div>
        <div class="main-content">
            <?php
            $pdo = new PDO($connect, USER, PASS);
            $sql = $pdo->prepare('SELECT player.*, position.position_name, home.home_name FROM player INNER JOIN position ON player.position_id = position.position_id INNER JOIN home ON player.home_id = home.home_id WHERE team_id = ? ORDER BY player.position_id');
            $sql->execute([$_SESSION['team']['team_id']]);

            echo '<table id="playerTable">';
            echo '<thead>';
            echo '<tr>';
            echo '<th onclick="sortTable(0)">', '背番号', '</th>';
            echo '<th onclick="sortTable(1)">', '選手名', '</th>';
            echo '<th onclick="sortTable(2)">', 'ポジション', '</th>';
            echo '<th onclick="sortTable(3)">', '出身地', '</th>';
            echo '<th onclick="sortTable(4)">', '年俸', '</th>';
            echo '<th onclick="sortTable(5)">', '在籍年数', '</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            foreach ($sql as $row) {
                echo '<tr>';
                echo '<td>', $row['player_number'], '</td>';
                echo '<td>';
                echo '<a href="player_syousai.php?player_id=', $row['player_id'], '&position_id=', $row['position_id'], '">', $row['player_name'], '</a>';
                echo '</td>';
                echo '<td>', $row['position_name'], '</td>'; 
                echo '<td>', $row['home_name'], '</td>';
                echo '<td>', $row['player_salary'], '</td>';
                echo '<td>', $row['player_year'], '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
            ?>
        </div>
    </div>
</div>

<script>
    function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("playerTable");
        switching = true;
        dir = "asc";
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("td")[n];
                y = rows[i + 1].getElementsByTagName("td")[n];
                if (n === 0) { // Check if the column is the "背番号" column
                    if (dir == "asc") {
                        if (parseInt(x.innerHTML) > parseInt(y.innerHTML)) {
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (parseInt(x.innerHTML) < parseInt(y.innerHTML)) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                } else { // For other columns, perform string comparison
                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount++;
            } else {
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }
</script>

</body>
</html>
