<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
$pdo=new PDO($connect,USER,PASS);
if(!isset($_SESSION['admins'])){
    $sql=$pdo->prepare('insert into Admins values(null,?,?)');
    $sql->execute([
        $_POST['admin_email'],
        password_hash($_POST['admin_password'],PASSWORD_DEFAULT)]);

    echo '<h3>&cosme</h3>';
    echo '<hr>';
    echo '<h2>登録完了</h2>';
    echo '<p><font color="FF0000">',$_POST['admin_email'],'様</font></p>';
    echo '<p><font color="FF0000">会員登録ありがとうございます。</font></p>';
    echo '<form action="k_home.php" method="post">';
    echo '<button class="ao">ホームへ</button>';
    echo '</form><hr>';
}
?>
<?php require 'footer.php'; ?>
 
