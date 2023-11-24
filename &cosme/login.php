<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
$msg;
if(isset($_POST['mail'])){
    unset($_SESSION['customer']);
    
    $pdo = new PDO($connect, USER, PASS);
    $sql = $pdo -> prepare('select * from Members where email=?');
    $sql -> execute([$_POST['mail']]);
    
    foreach($sql as $row){
          if(password_verify($_POST['pass'],$row['member_password'])==true){
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
echo '<div id="hr2">';
echo '<hr color="black">';
echo '</div>';
echo '<div id="logtitle">';
echo '<h2>ログイン</h2>';
echo '</div>';
if(isset($msg)){
    echo '<p>', $msg, '</p>';
}

echo '<form action="login.php" method="post">';
echo '<div id="meru">';
echo '<input type="text" style="width: 200px;height: 30px;"name="mail" placeholder="メールアドレス">';
echo '</div>';
echo '<div id="pas">';
echo '<input type="text" style="width: 200px;height: 30px;" name="pass"placeholder="パスワード">';
echo '</div>';
echo '<br>';
echo '<p><button class="ao" type="submit" href="home.php">ログイン</button></p>';
echo '</form>';
echo '<div id="hr1">';
echo '<hr width="250">';
echo '</div>';
echo '<br>';
echo '<div id="mannaka">';
echo '<p>アカウントをお持ちでない方はこちら</p>';
echo '<br>';
echo '<a href="member_new.php">新規会員登録</a>';
echo '</div>';
?>
<?php require 'footer.php'; ?>
