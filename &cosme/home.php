<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>







<table>
<?php
    echo '👑今週のランキング';
    echo '<table>';
    $pdo = new PDO($connect, USER, PASS);
    $sql = $pdo -> query('select * from Cosmetics order by cosme_id desc limit 3');
    //$sql = $pdo -> query('');
    //select * from OrderDetails as O join Cosmetics as C on O.cosme_id = C.cosme_id group by cosme_id order by quantity desc limit 3
    
    echo '<tr>';
    foreach($sql as $row){
        echo '<td><a href="detail.html"><img src="',$row['image_path'],'"></a></td>';
    }
    echo '</tr>';
    echo '</table>';
    
    echo '⏰新作情報';
    echo '<table>';
    $sql2 = $pdo -> query('select * from Cosmetics where creation_date >= date_add(now(), interval - 30 day)');    
    echo '<tr>';
    $count = 1;
    
    foreach($sql2 as $row2){
        if($count%4!=0){
            echo '<td><a href="detail.html"><img src="',$row2['image_path'],'"></a></td>';
        }else{
            echo '</tr><tr>';
        }
        $count++;
    }
    echo '</table>';
?>
</table>
<?php require 'footer.php' ?>

