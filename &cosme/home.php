<?php session_start(); ?>
<?php
if(empty($_SESSION['customer'])){
    header('Location: ./error.php');
    exit();
}
?>
<?php require 'header.php'; ?>
<?php require 'menu_home.php'; ?>
<?php require 'db_connect.php'; ?>
<?php
    echo '<table>';
        echo '👑今週のランキング';
        $pdo = new PDO($connect, USER, PASS);
        $sql = $pdo -> query('select C.cosme_name, C.cosme_id, C.image_path, SUM(OD.quantity) from Cosmetics C inner join OrderDetails OD ON C.cosme_id=OD.cosme_id INNER JOIN Orders O ON OD.order_id=O.order_id WHERE order_date>=(NOW()-INTERVAL 7 day) GROUP BY C.cosme_id ORDER BY SUM(OD.quantity) DESC LIMIT 7');
        $countRank = 1;
        $count = 1;
        echo '<br>';
        echo '<br>';
        //順位
       
        //画像表示
        echo '<table width="100%">';
        echo '<tr><td>1位</td> <td>2位</td> <td>3位</td></tr>';
        echo '<tr>';
        foreach($sql as $row){
            if($countRank%4!=0){
                echo '<td align="center"><a href="detail.php?cosme_id=',$row['cosme_id'],'&home=0"><img src="',$row['image_path'],'" widh="80" height="80"></a><br><font size="-1px"><div class="a">',$row['cosme_name'],'</div></font></td>';
            }else{
                echo '</tr><tr><td>4位</td> <td>5位</td> <td>6位</td></tr>';
            }
            $countRank++;
        }
        echo '</table><br><br>';
        
        //新作情報
        $sql2 = $pdo -> query('select min(cosme_id), image_path, cosme_name from Cosmetics where creation_date >= date_add(now(), interval - 10 day) group by group_id order by cosme_id desc'); 
        
        $count = 1;
        echo '⏰新作情報';
        echo '<table width="90%" cellpadding="10">';
        echo '<tr>';
        foreach($sql2 as $row2){
            if($count%4!=0){
                echo '<td align="center"><a href="detail.php?cosme_id=',$row2['min(cosme_id)'],'&home=0"><img src="',$row2['image_path'],'" widh="80" height="80"></a><br><font size="-1px">
                <div class="a">',$row2['cosme_name'],'</div></font></td>';
                //ｃｓｓ
            }else{
                echo '</tr><tr>';
            }
            $count++;
        }
        echo '</table>';
    echo '</table>';
?>
<?php require 'footer.php'; ?>
