<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
$msg;
if(isset($_POST['admin_email'])){
    unset($_SESSION['admins']);
    
    $pdo = new PDO($connect, USER, PASS);
    $sql = $pdo -> prepare('select * from Admins where admin_email=?');
    $sql -> execute([$_POST['admin_email']]);
    $password=$_POST['admin_password'];    
    foreach($sql as $row){
          if(password_verify($_POST['admin_password'],$row['admin_password'])==true){
            $_SESSION['admins'] = [
                'code' => $row['admin_code'],
                'mail' => $row['admin_email'],
                'pass' => $password];
             }
         }

    if(isset($_SESSION['admins'])){
        header('Location: ./k_home.php');
        exit();
    }else{
        $msg = '<font color="FF0000">ログイン名またはパスワードが違います</font>';
    }
}
require 'header.php';
echo '<h3>&cosme</h3>';
echo '<h2>ログイン</h2>';
echo '<div id="hr2">';

echo '<hr color="black">';
echo '</div>';


echo '<form action="k_login.php" method="post">';

echo '<input type="text" name="admin_email" placeholder="メールアドレス"><br>';
echo '<input type="password" name="admin_password"placeholder="パスワード">';

if(isset($msg)){
    echo '<p><div id="mannaka">', $msg, '</p></div>';
}

echo '<br>';
echo '<p><button class="ao" type="submit" href="k_home.php">ログイン</button></p>';
echo '</form>';
echo '<div id="hr1">';
echo '<hr width="250">';
echo '</div>';
echo '<br>';
echo '<div id="mannaka">';
echo '<p>アカウントをお持ちでない方はこちら</p>';
echo '<br>';
echo '<a href="k_member_new.php">新規登録</a>';
echo '</div>';
?>
<?php require 'footer.php'; ?>

