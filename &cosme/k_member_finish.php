<?php
session_start();
if(empty($_SESSION['admin'])){
    header('Location: ./k_error.php');
    exit();
}
?>
<?php require 'k_header.php'; ?>
<?php require 'db_connect.php'; ?>
<?php
$pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->prepare('insert into Admins values(null,?,?)');
    $sql->execute([
        $_POST['admin_email'],
        password_hash($_POST['admin_password'],PASSWORD_DEFAULT)]);

    echo '<h3>&cosme</h3>';
    echo '<div id="center">';
    echo '<h2>登録完了</h2>';
    echo '<hr color="black">';
    echo '</div>';
    echo '<div id="center">'; 
    echo '<p><font color="FF0000">',$_POST['admin_email'],'の管理者登録が完了しました。</font></p>';
    echo '</div>';
    echo '<form action="k_home.php" method="post">';
    echo '<button class="ao" style="width: 300px;height: 30px;">ホームへ</button>';
    echo '</form><hr>';
    unset($_SESSION['newAdmin']);
?>
<?php require 'footer.php'; ?>
 
