
<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<?php
$pdo=new PDO($connect,USER,PASS);
if(isset($_SESSION['customer'])){
    $id=$_SESSION['customer']['id'];
    $sql=$pdo->prepare('select * from Members where id!=? and login=?');
    $sql->execute([$id, $_POST['login']]);
}else{
    $sql=$pdo->prepare('select * from Members where login=?');
    $sql->execute([$_POST['login']]);
}
if(empty($sql->fetchAll())){
    //if(!isset($_SESSION['customer'])){
        $ads=$_POST['prefecture']+$_POST['city']+ $_POST['address']+$_POST['bill'];
            $sql=$pdo->prepare('insert into Members values(null,?,?,?,?,?,?,?,?,?)');
            $sql->execute([
                $_POST['sei'],$_POST['mei'],
                $_POST['seikana'],$_POST['meikana'],
                $_POST['zipcode'],
                $ads,$_POST['tel'],$_POST['mail'],
                $_POST['pass']
 
             ]);
             $sql2=$pdo->prepare('insert into Mypage (member_nickname) values(?)');
             $sql2->execute([$_POST['nickname']]);
            echo 'お客様情報を登録しました。';
        }else{
            echo '会員情報がすでに登録されていますので、変更してください。';
        //}
    }
?>
<?php require 'footer.php'; ?>
 
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>新規会員登録完了画面</title>
</head>
<body>
    <h3>&cosme</h3>
    <hr>
    <h2>登録完了</h2>
    <p><font color="FF0000">〇〇〇様</font></p>
    <p><font color="FF0000">会員登録ありがとうございます。</font></p>
    <div class="ao"><button onclick="location.href='home.html'">ホームへ</button></div>
    <hr>
    <p>登録情報を確認・変更できます</p>
    <a href="mypage.html">＞マイページへ</a>
</body>
</html>
 