<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php require 'header.php'; ?>
<h3>&cosme</h3>
    <hr color="black">
    <!--個人情報画面に遷移-->
    <div class="modoru"><a href="mypage.php">戻る</a></div>
    <form action="member_change.php" method="post">
        <div id="logtitle"><h2>個人情報</h2></div>
        <?php
         if(isset($_POST['sei'])){
            $password=$_POST['pass'];
        $pdo=new PDO($connect,USER,PASS);
        $sql=$pdo->prepare('update Members set family_name=?,first_name=?,family_name_kana=?,first_name_kana=?,post_code=?,prefecture=?,city=?,section=?,building=?,phone=?,email=?,member_password=? where member_code=?');
        $sql->execute([
            $_POST['sei'],
            $_POST['mei'],
            $_POST['seikana'],
            $_POST['meikana'],
            $_POST['zipcode'],
            $_POST['prefecture'],
            $_POST['city'],
            $_POST['address'],
            $_POST['bill'],
            $_POST['tel'],
            $_POST['mail'],
            password_hash($_POST['pass'],PASSWORD_DEFAULT),
            $_SESSION['customer']['code']
        ]);
        unset($_SESSION['customer']);
        $sql = $pdo -> prepare('select * from Members where email=?');
        $sql -> execute([$_POST['mail']]);
        $password=$_POST['pass'];    
        foreach($sql as $row){
              if(password_verify($_POST['pass'],$row['member_password'])==true){
                $_SESSION['customer'] = [
                    'code' => $row['member_code'],
                    'familyName' => $row['family_name'],
                    'firstName' => $row['first_name'],
                    'familyKana' => $row['family_name_kana'],
                    'firstKana' => $row['first_name_kana'],
                    'post' => $row['post_code'],
                    'prefecture'=>$row['prefecture'],
                    'city'=>$row['city'],
                    'section'=>$row['section'],
                    'building'=>$row['building'],
                    'phone' => $row['phone'],
                    'mail' => $row['email'],
                    'pass' => $password];
                 }
             }
        echo 'お客様情報を更新しました。';
    }
        $pdo=new PDO($connect,USER,PASS);
        $sql=$pdo->prepare(
            'select * from Members where member_code=?');
        $sql->execute([$_SESSION['customer']['code']]);
    foreach($sql as $row){
       echo '<div id="simei">';
       echo '<input type="text" style="width: 102px;height: 30px;" name="sei" value="',$row['family_name'],'" readonly>';
       echo '<input type="text" style="width: 102px;height: 30px;" name="mei" value="',$row['first_name'],'" readonly>';
       echo '</div>';
       echo '<div id="mannaka">';
       echo '<p><input type="text" style="width: 125px;height: 30px;" name="seikana" value="',$row['family_name_kana'],'" readonly>';
       echo '<input type="text" style="width: 125px;height: 30px;" name="meikana" value="',$row['first_name_kana'],'" readonly></p>';
       echo '</div>';
       echo '<div id="yuubin">';
       echo '<input type="text" style="width: 240px;height: 27px;" name="zipcode" value="',$row['post_code'],'" readonly>';
       echo '</div>';
       echo '<div id="toroku1">';
       echo '<p><input type="text" name="prefecture" value="',$row['prefecture'],'" readonly></p>';
       echo '<p><input type="text" name="city" value="',$row['city'],'" readonly></p>';
       echo '<p><input type="text" name="address" value="',$row['section'],'" readonly></p>';
       echo '<p><input type="text" name="bill" value="',$row['building'],'" ></p>';
       echo '</div>';
       echo '<div id="tell">';
       echo '<input type="text" style="width: 240px;height: 27px;" name="tel" value="',$row['phone'],'" readonly>';
       echo '</div>';
       echo '<br>';
       echo '<div id="meru2">';
       echo '<input type="text" style="width: 240px;height: 27px;" name="mail" value="',$row['email'],'" readonly>';
       echo '</div>';
       echo '<br>';
       echo '<div id="pas2">';
       echo '<input type="password" style="width: 240px;height: 27px;" name="pass" value="',$_SESSION['customer']['pass'],'" readonly>';
       echo '</div>';
       
    }

    ?>
    <br>
<p><button class="ao" type="submit" href="member_change.php">会員情報の変更</button></p>
    </form>
<?php require 'footer.php'; ?>