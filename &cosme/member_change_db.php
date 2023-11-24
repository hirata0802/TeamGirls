<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
    if(isset($_POST['sei'])){
        $pdo=new PDO($connect,USER,PASS);
        $sql=$pdo->prepare('update Members set family_name=?,first_name=?,family_name_kana=?,first_name_kana=?,post_code=?,address=?,phone=?,email=?)');
        $sql->execute([
            $_POST['sei'],$_POST['mei'],
            $_POST['seikana'],$_POST['meikana'],
            $_POST['zipcode'],
            $ads,$_POST['tel'],$_POST['mail'],
        ]);
        echo 'お客様情報を更新しました。';
    }
    
?>