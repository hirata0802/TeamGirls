<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>ログイン画面</title>
</head>
<body>
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
?>
<h3>&cosme</h3>
<hr color="black">
<div id="logtitle"><h2>ログイン</h2></div>
<?php
if(isset($msg)){
echo '<p>', $msg, '</p>';
}
?>
<form action="login.php" method="post">
<div id="meru"><input type="text" style="width: 200px;height: 30px;"name="mail" placeholder="メールアドレス">
    </div>
    <div id="pas"><input type="text" style="width: 200px;height: 30px;" name="pass"placeholder="パスワード"></form></div>
    <p><button class="ao" type="submit">ログイン</button></p></div>
    <div id="hr1"><hr width="250"></div>
    <div id="mannaka"><p>アカウントをお持ちでない方はこちら</p>
        <br>
    <a href="f_shinki.html">新規会員登録</a></div>
</form>
</body>
</html>