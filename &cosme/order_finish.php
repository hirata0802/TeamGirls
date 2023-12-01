<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php
    $pdo=new PDO($connect, USER, PASS);
    //Orders登録
    $order=$pdo->prepare('insert into Orders values (null, ?, current_date, ?, ?)');
    $order->execute([$row['cart_id']]);
    $cart=$pdo->prepare('select * from Cart as C inner join Cosmetics as CO on C.cosme_id=CO.cosme_id where member_code=? and C.delete_flag=0');
    $cart->execute([$_SESSION['customer']['code']]);
    foreach($cart as $row){
        //Carts更新
        $sql=$pdo->prepare('update Cart set delete_flag=2 where cart_id=?');
        $sql->execute([$row['cart_id']]);
        //OrderDetail登録
    }


    $sql=$pdo->prepare('update ');
    $sql->execute([$_SESSION['customer']['code'], $_SESSION['customer']['code']]);

?>
<?php
    echo '<h3>&cosme</h3>';
    echo '<hr>';
    echo '<h2>購入完了</h2>';
    echo '<p><font color="FF0000">', $_SESSION['customer']['familyName'], '　', $_SESSION['customer']['firstName'], '　様</font></p>';
    echo '<p><font color="FF0000">ご購入ありがとうございます。</font></p>';
    echo '<div class="ao"><button onclick="location.href=`home.php`">ホームへ</button></div>';
?>
<?php require 'footer.php'; ?>