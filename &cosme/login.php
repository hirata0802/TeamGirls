<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
$msg;
if(isset($_POST['login'])){
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
        $msg = 'ログイン名またはパスワードが違います';
    }
}
require 'header.php';
echo '<h3>&cosme</h3>';
echo '<hr>';
echo '<h2>ログイン</h2>';
if(isset($msg)){
echo '<p>', $msg, '</p>';
}

echo '<form action="login.php" method="post">';
echo '<p><input type="text" name="mail" placeholder="メールアドレス"></p>';
echo  '<p><input type="password" name="pass" placeholder="パスワード"></p>';
echo  '<p><input name="login" type="submit" value="ログイン"></p>';
echo '</form>';
echo '<hr>';
echo '<p>アカウントをお持ちでない方はこちら</p>';
echo '<a href="member_new.php">新規会員登録</a>';
?>
<?php require 'footer.php'; ?>