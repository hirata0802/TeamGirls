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
        echo '<div id="mannaka">';
        echo 'お客様情報を更新しました。';
        echo '</div>';
        echo '<br>';
    }
        $pdo=new PDO($connect,USER,PASS);
        $sql=$pdo->prepare(
            'select * from Members where member_code=?');
        $sql->execute([$_SESSION['customer']['code']]);
    foreach($sql as $row){
        echo '<table align="center">';
        echo '<div id="simei"></div>';
            echo '<input type="hidden" name="sei" value="',$row['family_name'],'">';
            echo '<input type="hidden" name="mei" value="',$row['first_name'],'">';
            echo '<p align="center">姓名：',$row['family_name'],'　　',$row['first_name'],'</p>';
       

       echo '<div id="mannaka"></div>';
            echo '<input type="hidden" name="seikana" value="',$row['family_name_kana'],'">';
            echo '<input type="hidden" name="meikana" value="',$row['first_name_kana'],'">';
            echo '<p align="center">セイメイ：',$row['family_name_kana'],'　　',$row['first_name_kana'],'</p>';
       

       echo '<div id="yuubin"></div>';
            echo '<input type="hidden" name="zipcode" value="',$row['post_code'],'">';
            echo '<p align="center">郵便番号：',$row['post_code'],'</p>';

       echo '<div id="toroku1"></div>';
       echo '<input type="hidden" name="prefecture" value="',$row['prefecture'],'">';
       echo '<input type="hidden" name="city" value="',$row['city'],'">';
       echo '<input type="hidden" name="address" value="',$row['section'],'">';
       echo '<input type="hidden" name="bill" value="',$row['building'],'">';
       echo '<p align="center">都道府県：',$row['prefecture'],'</p>';
       echo '<p align="center">市町村：',$row['city'],'</p>';
       echo '<p align="center">番地：',$row['section'],'</p>';
       echo '<p align="center">ビル・マンション名：',$row['building'],'</p>';


       echo '<div id="tell"></div>';
            echo '<input type="hidden" name="tel" value="',$row['phone'],'">';
            echo '<p align="center">電話番号：',$row['phone'],'</p>';

       echo '<br>';
       echo '<div id="meru2"></div>';
       echo '<input type="hidden" name="mail" value="',$row['email'],'">';
       echo '<p align="center">メールアドレス：',$row['email'],'</p>';

       echo '<br>';
       echo '<div id="pas2"></div>';
       echo '<input type="hidden" name="pass" value="',$_SESSION['customer']['pass'],'">';
       echo '<p align="center">パスワード：',$_SESSION['customer']['pass'],'</p>';

       echo '</table>';
    }

    ?>
    <br>
<p><button class="ao" type="submit" href="member_change.php">会員情報の変更</button></p>
    </form>
<?php require 'footer.php'; ?>