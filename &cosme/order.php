<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php require 'db_connect.php'; ?>
<h2>レジ</h2>
<form action="order_check.php" method="post">
<?php
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('select * from Addresses where member_code=? and register_date=(select max(register_date) from Addresses where member_code=?);');
    $sql->execute([$_SESSION['customer']['code'], $_SESSION['customer']['code']]);

    foreach($sql as $row){
        echo '<dl>';
        echo '<dt>商品合計</dt><dd>', $_POST['total'], '円</dd>';
        echo '<dt>お届け先</dt><dd>', $row['address_name'], '　様<br>';
        echo '〒', $row['post_code'], '<br>';
        echo $row['address'], '<br>';
        echo $row['phone'], '</dd>';
        echo '<dd><div class="white"><button type="submit" onclick="location.href=`order_add.php`">お届け先追加</button></div></dd>';
        echo '<dd><div class="white"><button type="submit" onclick="location.href=`order_change.php`">お届け先変更</button></div></dd>';
    }
    
    echo '<dt>支払い方法</dt>';
    echo '<dd>';
    echo '<div class="radio-wrap">';
    echo '<input type="radio" name="test" value="現金">現金<br>';
    echo '<input type="radio" name="test" value="コンビニ払い">コンビニ払い<br>';
    echo '<input type="radio" name="test" value="クレジットカード">クレジットカード<br>';
    echo '</div>';
    echo '</dd>';
    echo '</dl>';
    echo '<hr>';
    echo '<div class="ao"><button type="submit">確認する</button></div>';
?>
</form>
<div class="grey"><button onclick="location.href='cart.html'">戻る</button></div>
<?php require 'footer.php'; ?>