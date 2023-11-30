<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php require 'db_connect.php'; ?>
<h2>ご注文履歴</h2>
<?php
    if(isset($_SESSION['customer'])){
        $pdo=new PDO($connect, USER, PASS);
        $sql=$pdo->prepare('select * from Orders where member_code=? order by order_date desc');
        $sql->execute([$_SESSION['customer']['code']]);
        
        foreach($sql as $row){
            echo '<p>', $row['order_date'], '</p>';
            $sql2=$pdo->prepare('select * from OrderDetails OD inner join Cosmetics C on OD.cosme_id=C.cosme_id where OD.order_id=? order by C.cosme_id');
            $sql2->execute([$row['order_id']]);
            foreach($sql2 as $row2){
                echo '<table><tr>';
                echo '<td><img src="', $row2['image_path'], '" alt="" width="120px"></td>';
                echo '<td align="left">',$row2['cosme_name'],'<br>';
                echo $row2['color_name'],'<br>';
                echo $row2['quantity'],'個</td>';
                echo '<td><button class="ao" onclick="location.href=`review_new.php?Rnew=', $row2['cosme_id'], '&page=1`" id="buttonsize">レビューを書く</button></td></tr></table>';
            }
            echo $row['total_price'], '円<br>';
            echo $row['pay_method'];
        }
    }
    ?>
<?php require 'footer.php'; ?>