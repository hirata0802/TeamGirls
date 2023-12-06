<?php session_start(); ?>
<?php
if(empty($_SESSION['customer'])){
    header('Location: ./error.php');
    exit();
}
?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php require 'db_connect.php'; ?>
<?php
    echo '<div id="logtitle">';
    echo '<h2>注文内容の確認</h2>';
    echo '</div>';
    echo '<form action="order_finish.php" method="post">';
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('select * from Addresses where member_code=? and register_date=(select max(register_date) from Addresses where member_code=?)');
    $sql->execute([$_SESSION['customer']['code'], $_SESSION['customer']['code']]);
    
    foreach($sql as $row){
        $ads=$row['prefecture'].$row['city'].$row['section']. "<br>" .$row['building'];
        echo '<dl>';
        echo '<div id="dai">';
        echo '<dt>お届け先：</dt><dd>';
        echo '</div>';
        echo '<div id="text1">';
        echo $row['address_name'], '　様<br>';
        echo '〒', $row['post_code'], '<br>';
        echo $ads, '<br>';
        echo $row['phone'], '</dd>';
        echo '</div>';
        echo '<br>';
        echo '<div id="dai">';
        echo '支払い方法：';
        echo '</div>';
        echo '<div id="text1">';
        echo  $_POST['pay'];
        echo '</div>';
        echo '<br>';
        echo '<div id="dai">';
        echo '<dt>商品合計</dt><dd>';
        echo '</div>';
        echo '<div id="text1">';
        echo  $_POST['total'], '円</dd>';
        echo '</div>';
    }
    echo '<dl>';
    
    //購入商品
    $cart=$pdo->prepare('select * from Cart as C inner join Cosmetics as CO on C.cosme_id=CO.cosme_id where member_code=? and C.delete_flag=0');
    $cart->execute([$_SESSION['customer']['code']]);
    foreach($cart as $row){
        //echo '<img src="', $row['image_path'], '" style="object-fit: contain; width: 100px; height: 100px;">';
        echo '<div id="text1">';
        echo $row['cosme_name'], '　';
        echo '<br>';
        echo 'カラー：', $row['color_name'];
        echo $row['quantity'];
        echo '</div>';
        echo'<br>';
        echo '<br>';
    }
    echo '<input type="hidden" name="pay" value="', $_POST['pay'], '">';
    echo '<input type="hidden" name="total" value="', $_POST['total'], '">';
    echo '<br>';
    echo '<hr class="tensen">';
    echo '<br>';
    echo '<button type="submit" class="ao">注文を確定する</button></p>';
    echo '</form>';
    echo `<button type="button" onclick="location.href='order.php'" class="grey">変更</button></p><br>`;
?>
<?php require 'footer.php'; ?>