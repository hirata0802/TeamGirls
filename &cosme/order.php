<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php require 'db_connect.php'; ?>
<h2>レジ</h2>
<?php
    $pdo=new PDO($connect, USER, PASS);
    //お届け先
    $sql=$pdo->prepare('select * from Addresses where member_code=? and register_date=(select max(register_date) from Addresses where member_code=?);');
    $sql->execute([$_SESSION['customer']['code'], $_SESSION['customer']['code']]);
    foreach($sql as $row){
        $ads=$row['prefecture'].$row['city'].$row['section'].$row['building'];
        echo '<dl>';
        echo '<dt>お届け先</dt><dd>', $row['address_name'], '　様<br>';
        echo '〒', $row['post_code'], '<br>';
        echo $ads, '<br>';
        echo $row['phone'], '</dd>';
        echo '<dd><div class="white"><button type="submit" onclick="location.href=`order_add.php`">お届け先追加</button></div></dd>';
        echo '<dd><div class="white"><button type="submit" onclick="location.href=`order_change.php`">お届け先変更</button></div></dd>';
    }
    //購入商品
    $cart=$pdo->prepare('select * from Cart as C inner join Cosmetics as CO on C.cosme_id=CO.cosme_id where member_code=? and C.delete_flag=0');
    $cart->execute([$_SESSION['customer']['code']]);
    foreach($cart as $row){
        echo '<img src="', $row['image_path'], '" style="object-fit: contain; width: 100px; height: 100px;">';
        echo $row['cosme_name'];
        echo $row['color_name'];
        echo $row['quantity'];
        echo $row['quantity']*$row['price'];
    }
    //商品合計
    $total=$pdo->prepare('select sum(C.quantity * CO.price) as total from Cart as C inner join Cosmetics as CO on C.cosme_id=CO.cosme_id inner join Brands as B on CO.brand_id=B.brand_id where member_code=? and delete_flag=0');
    $total->execute([$_SESSION['customer']['code']]);
    foreach($total as $row){
        echo '<dt>商品合計</dt><dd>', $row['total'], '円</dd>';
    }
?>
<form action="order_check.php" method="post">
    <dt>支払い方法</dt>
    <dd>
    <div class="radio-wrap">
    <input type="radio" name="test" value="現金払い">現金払い<br>
    <input type="radio" name="test" value="コンビニ払い">コンビニ払い<br>
    <input type="radio" name="test" value="クレジットカード払い">クレジットカード払い<br>
    </div>
    </dd>
    </dl>
    <hr>
    <div class="ao"><button type="submit">確認する</button></div>
</form>
<div class="grey"><button onclick="location.href='cart.html'">戻る</button></div>
<?php require 'footer.php'; ?>