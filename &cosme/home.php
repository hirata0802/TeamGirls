<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>







<table>
<?php
    echo '👑今週のランキング';
    $pdo = new PDO($connect, USER, PASS);
    $sql = $pdo -> query('select * from Cosmetics order by cosme_id desc limit 3');
    $count = 1;
    //$sql = $pdo -> query('');
    //select * from OrderDetails as O join Cosmetics as C on O.cosme_id = C.cosme_id group by cosme_id order by quantity desc limit 3
    echo '<br>';
    echo '<br>';
    echo '<br>';
    echo '<br>';
    //順位
    echo '<table align="center" width="80%">';
    echo '<tr><td>1位</td> <td>2位</td> <td>3位</td></tr>';
    echo "</table>";
    //画像表示
    echo '<table align="center" width="50%" cellpadding="20">';
    echo '<tr>';
    foreach($sql as $row){
            echo '<td align="center"><a href="detail.php?cosme_id=',$row['cosme_id'],'"><img src="',$row['image_path'],'" widh="80" height="80"></a><br><font size="-5px">',$row['cosme_name'],'</font></td>';
    }
    echo '</tr>';
    echo '</table><br><br>';

    //新作情報
    $sql2 = $pdo -> query('select * from Cosmetics where creation_date >= date_add(now(), interval - 10 day)');       
    $count = 1;
    echo '⏰新作情報';
    echo '<table align="center" width="50%"  cellpadding="20">';
    echo '<tr>';
    foreach($sql2 as $row2){
        if($count%4!=0){
            echo '<td align="center"><a href="detail.php?cosme_id=',$row2['cosme_id'],'"><img src="',$row2['image_path'],'" widh="80" height="80"></a><br><font size="-5px">',$row2['cosme_name'],'</font></td>';
        }else{
            echo '</tr><tr>';
        }
        $count++;
    }
    echo '</table>';
?>
</table>
<?php require 'footer.php' ?>

