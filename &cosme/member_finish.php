<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'db_connect.php'; ?>
<?php
$pdo=new PDO($connect,USER,PASS);
if(!isset($_SESSION['customer'])){
      
        $ads=$_POST['prefecture'].$_POST['city'].$_POST['address'].$_POST['bill'];
            $sql=$pdo->prepare('insert into Members values(null,?,?,?,?,?,?,?,?,?)');
            $sql->execute([
                $_POST['sei'],$_POST['mei'],
                $_POST['seikana'],$_POST['meikana'],
                $_POST['zipcode'],
                $ads,$_POST['tel'],$_POST['mail'],
                $_POST['pass']]);

             $id=$pdo->lastInsertId();
             $sql2=$pdo->prepare('insert into Mypage (member_code,member_nickname) values(?,?)');
             $sql2->execute([$id,$_POST['nickname']]);
            echo '<h3>&cosme</h3>';
            echo '<hr>';
            echo '<h2>登録完了</h2>';
            echo '<p><font color="FF0000">',$_POST['sei'],$_POST['mei'],'様</font></p>';
            echo '<p><font color="FF0000">会員登録ありがとうございます。</font></p>';
            echo '<form action="home.php" method="post">';
            echo '<button class="ao">ホームへ</button>';
            echo '<hr>';
            echo '<p>登録情報を確認・変更できます</p>';
            echo '<a href="mypage.php">＞マイページへ</a>';
           

        }

?>
<?php require 'footer.php'; ?>
 
