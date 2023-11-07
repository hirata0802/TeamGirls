<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php require 'db-connect.php'; ?>

<?php

unset($_SESSION['member']);
$pdo = new PDO($connect,USER,PASS);
$sql = $pdo -> prepare('select * from Members where email=?');
$sql -> execute([$_POST['mail']]);

foreach($sql as $row){
    if(password_verify($_POST['pass'],$row['pass']) == true){
        $_SESSION['member'] = [
            'name' => $row['first_name']
        ];
    }
}

if(isset($_SESSION['member'])){
    echo 'いらっしゃいませ、',$_SESSION['member']['name'],'さん。';
}else{
    echo 'ログイン名またはパスワードが違います。';
}
?>
<?php require 'footer.php'; ?>