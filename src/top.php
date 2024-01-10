<?php require "db-connect.php" ?>
<?php require "head.php" ?>

<?php
     $pdo = new PDO($connect, USER, PASS);
     $sql = $pdo->query('select * from player');

     foreach($sql as $row) {
        echo $row['player_name'];
     }
?>

</body>
</html>
