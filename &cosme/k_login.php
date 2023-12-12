<?php session_start(); ?>
<?php require 'k_header.php'; ?>
<?php require 'db_connect.php'; ?>
<?php
$msg;
if(isset($_POST['admin_email'])){
    unset($_SESSION['admin']);
    
    $pdo = new PDO($connect, USER, PASS);
    $sql = $pdo -> prepare('select * from Admins where admin_email=?');
    $sql -> execute([$_POST['admin_email']]);
    $password=$_POST['admin_password'];    
    foreach($sql as $row){
          if(password_verify($_POST['admin_password'],$row['admin_password'])==true){
            $_SESSION['admin'] = [
                'code' => $row['admin_code'],
                'mail' => $row['admin_email'],
                'pass' => $password];
             }
         }
     
    if(isset($_SESSION['admin'])){
        header('Location: ./k_home.php');
        exit();
    }else{
        echo '<div id="center">';
        $msg = '<font color="FF0000">ログイン名またはパスワードが違います。</font>';
        echo '</div>';
    }
}


echo '<h3>&cosme</h3>';
echo '<div id="center"><h2>ログイン</h2></div>';
echo '<div id="hr2"><hr color="black"></div>';

echo '<form action="k_login.php" method="post">';
echo '<br><br>';
echo '<div id="center">';
echo '<input type="text" style="width: 400px;height: 30px;" name="admin_email" placeholder="メールアドレス">';
echo '<br><br>';
echo '<input type="password" style="width: 400px;height: 30px;" name="admin_password"placeholder="パスワード">';
echo '</div>';
if(isset($msg)){
    echo '<p><div id="mannaka">', $msg, '</p></div>';
}
echo '<br>';
echo '<p><button class="next" type="submit" href="k_home.php">ログイン</button></p>';
echo '</form>';
?>
<?php require 'footer.php'; ?>

