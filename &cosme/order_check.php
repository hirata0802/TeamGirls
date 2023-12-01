<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php require 'db_connect.php'; ?>
    <h2>注文内容の確認</h2>
<?php
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('select sum(C.quantity * CO.price) as total from Cart as C inner join Cosmetics as CO on C.cosme_id=CO.cosme_id inner join Brands as B on CO.brand_id=B.brand_id where member_code=? and delete_flag=0');
    $sql->execute([$_SESSION['customer']['code']]);
    $total;
    foreach($sql as $row){
        $total=$row['total'];
    }
    $sql=$pdo->prepare('select * from Addresses where member_code=? and register_date=(select max(register_date) from Addresses where member_code=?)');
    $sql->execute([$_SESSION['customer']['code'], $_SESSION['customer']['code']]);

    foreach($sql as $row){
        $ads=$row['prefecture'].$row['city'].$row['section'].$row['building'];
        echo '<dl>';
        echo '<dt>お届け先：</dt><dd>', $row['address_name'], '　様<br>';
        echo '〒', $row['post_code'], '<br>';
        echo $ads, '<br>';
        echo $row['phone'], '</dd>';
        echo '支払い方法：', $_POST['test'];
        echo '<dt>商品合計</dt><dd>', $total, '円</dd>';
    }
    echo '<dl>';
?>
    <div class="ao"><button onclick="location.href='order_finish.php'">注文を確定する</button></div>
    <div class="grey"><button onclick="location.href='cart.html'">変更</button></div>
<?php require 'footer.php'; ?>