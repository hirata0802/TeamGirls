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
                password_hash($_POST['pass'],PASSWORD_DEFAULT)]);

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
            foreach($sql as $row){
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

?>
<?php require 'footer.php'; ?>
 
