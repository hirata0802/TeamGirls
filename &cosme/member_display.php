<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php require 'header.php'; ?>
<h3>&cosme</h3>
<hr>
    <!--個人情報画面に遷移-->
    <div class="modoru"><a href="mypage.php">戻る</a></div>
    <form action="member_change.php" method="post">
        <div id="logtitle"><h2>個人情報</h2></div>
        <?php
         if(isset($_POST['sei'])){
        $pdo=new PDO($connect,USER,PASS);
        $sql=$pdo->prepare('update Members set family_name=?,first_name=?,family_name_kana=?,first_name_kana=?,post_code=?,address=?,phone=?,email=?,member_password=? where member_code=?');
        $sql->execute([
            $_POST['sei'],
            $_POST['mei'],
            $_POST['seikana'],
            $_POST['meikana'],
            $_POST['zipcode'],
            $_POST['address'],
            $_POST['tel'],
            $_POST['mail'],
            $_POST['pass'],
            $_SESSION['customer']['code']
        ]);
        echo 'お客様情報を更新しました。';
    }
        $pdo=new PDO($connect,USER,PASS);
        $sql=$pdo->prepare(
            'select * from Members where member_code=?');
        $sql->execute([$_SESSION['customer']['code']]);
    foreach($sql as $row){
       echo '<p><input type="text" name="sei" value="',$row['family_name'],'" readonly>';
       echo '<p><input type="text" name="mei" value="',$row['first_name'],'" readonly>';
       echo '<p><input type="text" name="seikana" value="',$row['family_name_kana'],'" readonly>';
       echo '<p><input type="text" name="meikana" value="',$row['first_name_kana'],'" readonly>';
       echo '<p><input type="text" name="zipcode" value="',$row['post_code'],'" readonly>';
       echo '<p><input type="text" name="address" value="',$row['address'],'" readonly>';
       echo '<p><input type="text" name="tel" value="',$row['phone'],'" readonly>';
       echo '<p><input type="text" name="mail" value="',$row['email'],'" readonly>';
       echo '<p><input type="password" name="pass" value="',$_SESSION['customer']['pass'],'" readonly>';
       
    }

    ?>
<p><button class="ao" type="submit" href="member_change.php">会員情報の変更</button></p>
    </form>
<?php require 'footer.php'; ?>