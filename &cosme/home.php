<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>

<h2>今週のランキング</h2>
<table>
<?php
    echo '👑今週のランキング';
    echo '<table>';
    $pdo = new PDO($connect, USER, PASS);
    $sql = $pdo -> query('select * from OrderDetails as O join Cosmetics as C on O.cosme_id = C.cosme_id group by cosme_id order by quantity desc limit 3');
    foreach($sql as $row){
        echo '<tr>';
        echo '<td><img src="',$row['image_path'],'"></td>';
        echo '</tr>';
    }
    echo '</table>';
    
    echo '⏰新作情報';
    echo '<table>';
    $sql2 = $pdo -> query('select * from Cosmetics where creation_date >= (now()-interval 1month)');
    foreach($sql2 as $row2){
        echo '<tr>';
        echo '<td><img src="',$row2['image_path'],'">';
        echo '</tr>';
    }
    echo '</table>';
?>
</table>
<?php require 'footer.php' ?>

