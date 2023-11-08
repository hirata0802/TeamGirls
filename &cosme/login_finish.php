<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php

unset($_SESSION['customer']);

$pdo = new PDO($connect, USER, PASS);
$sql = $pdo -> prepare('select * from Members where email=? and member_password=?');
$sql -> execute([$_POST['mail'],$_POST['pass']]);

foreach($sql as $row){
    //if($_POST['pass']==$row['member_password']){
        $_SESSION['customer'] = [
            'code' => $row['member_code'],
            'familyName' => $row['family_name'],
            'firstName' => $row['first_name'],
            'familyKana' => $row['family_name_kana'],
            'firstKana' => $row['first_name_kana'],
            'post' => $row['post_code'],
            'address' => $row['address'],
            'phone' => $row['phone'],
            'mail' => $row['email'],
            'pass' => $row['member_password']];
        }


if(isset($_SESSION['customer'])){
    header('Location: ./home.php');
    exit();
}else{
    require 'header.php';
    echo 'ログイン名またはパスワードが違います';
}

?>
<?php require 'footer.php'; ?>