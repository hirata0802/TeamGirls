<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>

    <h2>今週のランキング</h2>
    <table>
<?php
    //今週のランキング;
    $pdo = new PDO($connect, USER, PASS);
    $sql = $pdo -> query('select * from Cosmetics order by price desc');
    foreach($sql as $row){
        echo '<tr>';
        echo '<td>', $row['cosme_name'], '</td>';
        echo '<td>', $row['price'], '</td>';
        echo '</tr>';
    }
    //新作情報;}
?>
</table>
</body>
</html>
<?php
 $pdo = null;   //DB切断
 ?>

