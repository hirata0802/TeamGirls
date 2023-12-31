<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
if(empty($_SESSION['customer'])){
    header('Location: ./error.php');
    exit();
}
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('select C.cart_id, B.brand_name, CO.cosme_name, CO.price, CO.color_name, C.quantity from Cart as C inner join Cosmetics as CO on C.cosme_id=CO.cosme_id inner join Brands as B on CO.brand_id=B.brand_id where member_code=? and delete_flag=0');
    $sql->execute([$_SESSION['customer']['code']]);
    if($sql->rowCount() == 0){
        header('Location: ./cart_nothing.php');
        exit();
    }else{
        header('Location: ./cart.html');
        exit();
    }
?>