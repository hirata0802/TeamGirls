<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php require 'db_connect.php'; ?>
<h2>ご注文履歴</h2>
<?php
    if(isset($_SESSION['customer'])){
        $pdo=new PDO($connect, USER, PASS);
        $sql=$pdo->prepare('select * from Orders O inner join OrderDetails OD on O.order_id=OD.order_id where O.member_code=? order by O.order_date desc');
        $sql->execute([$_SESSION['customer']['code']]);
        
        foreach($sql as $row){
            echo '<p>', $row['O.order_data'];
            $sql2=$pdo->prepare('select * from OrderDetails OD on O.order_id=OD.order_id inner join Cosmetics C on OD.cosme_id=C.cosme_id where OD.order_id=? order by C.cosme_id');
            $sql->execute([$row['O.order_id']]);
            foreach($sql2 as $row2){
                echo '<img src="', $row['C.image_path'], '" alt="">';
                echo $row2['C.cosme_name'];
                echo $row2['C.color_name'];
                echo $row2['OD.quantity'];
                echo '<button type="button" onclick="Location.href=``">レビューを書く</button>';
            }
            echo $row['O.total_price'], '</p>';
            echo $row['O.pay_method'], '</p>';
        }
    }
    ?>
<?php require 'footer.php'; ?>