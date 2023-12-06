<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
if(empty($_SESSION['customer'])){
    header('Location: ./error.php');
    exit();
}
    $pdo=new PDO($connect, USER, PASS);
    $data=json_decode(file_get_contents('php://input'), true);
    foreach($data as $js){
        if($js['delete_flag']==0){
            $sql=$pdo->prepare('update Cart set quantity=? where cart_id=?');
            $sql->execute([$js['quantity'], $js['cart_id']]);
        }
        else{
            $sql=$pdo->prepare('delete from Cart where cart_id=?');
            $sql->execute([$js['cart_id']]);
        }
    }
?>