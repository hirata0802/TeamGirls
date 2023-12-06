<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php require 'db_connect.php'; ?>
<?php
    $pdo=new PDO($connect, USER, PASS);
    //Orders登録
    $order=$pdo->prepare('insert into Orders values (null, ?, current_date, ?, ?)');
    $order->execute([$_SESSION['customer']['code'], $_POST['total'], $_POST['pay']]);
    $orderId=$pdo->lastInsertId();
    $cart=$pdo->prepare('select * from Cart as C inner join Cosmetics as CO on C.cosme_id=CO.cosme_id where member_code=?');
    $cart->execute([$_SESSION['customer']['code']]);
    foreach($cart as $row){
        //OrderDetail登録
        $orderdetail=$pdo->prepare('insert into OrderDetails values (?, ?, ?)');
        $orderdetail->execute([$row['cosme_id'], $orderId, $row['quantity']]);
        //Carts更新
        $delcart=$pdo->prepare('delete from Cart where cart_id=?');
        $delcart->execute([$row['cart_id']]);
    }
    echo '<h3>&cosme</h3>';
    echo '<hr>';
    echo '<h2>購入完了</h2>';
    echo '<p><font color="FF0000">', $_SESSION['customer']['familyName'], '　', $_SESSION['customer']['firstName'], '　様</font></p>';
    echo '<p><font color="FF0000">ご購入ありがとうございます。</font></p>';
    echo '<div class="ao"><button onclick="location.href=`home.php`">ホームへ</button></div>';
?>
<?php require 'footer.php'; ?>