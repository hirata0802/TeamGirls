<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php require 'db_connect.php'; ?>
<?php
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('select * from Addresses where member_code=?');
    $sql->execute([$_SESSION['customer']['code']]);
    foreach($sql as $row){
        echo '<input type="radio" name="address" value="', $row['address_id'], '">';
        echo '<dl>'
        echo '<dt>商品合計</dt><dd>', $_POST['total'], '円</dd>';
        echo '<dt>お届け先</dt><dd>', $row['address_name'], '　様<br>';
        echo '〒', $row['post_code'], '<br>';
        echo $row['address'], '<br>';
        echo $row['phone'], '</dd>';
    }
    echo '<input type="submit" value="選択" onclick="location.href=`order_db_insert.php?order=1`">';
?>
<?php require 'footer.php'; ?>