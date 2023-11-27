<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php require 'db_connect.php'; ?>
    <h2>注文内容の確認</h2>
    <form action="order_finish.php" method="post">
<?php
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('select * from Addresses where member_code=? and register_date=(select max(register_date) from Addresses where member_code=?)');
    $sql->execute([$_SESSION['customer']['code'], $_SESSION['customer']['code']]);

    foreach($sql as $row){
        echo '<dl>';
        echo '<dt>お届け先：</dt><dd>', $row['address_name'], '　様<br>';
        echo '〒', $row['post_code'], '<br>';
        echo $row['address'], '<br>';
        echo $row['phone'], '</dd>';
        echo '支払い方法：', $_POST['test'];
        echo '<dt>商品合計</dt><dd>', $_POST['total'], '円</dd>';
    }
    echo '<dl>';
    echo '<dt>お届け先：</dt>';
?>
        <div class="ao"><button type="submit">注文を確定する</button></div>
    </form>
    <div class="grey"><button onclick="location.href='cart.html'">変更</button></div>
<?php require 'footer.php'; ?>