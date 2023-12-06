<?php session_start(); ?>
<?php
if (!empty($_SESSION['customer'])) {
    require 'header.php';
    require 'db_connect.php';
    echo '<h3>&cosme</h3>';
    echo '<hr color="black">';
    echo '<div class="modoru"><a href="mypage.php">戻る</a></div>';
    echo '<form action="member_change.php" method="post">';
    echo '<div id="logtitle"><h2>個人情報</h2></div>';
    $pdo=new PDO($connect,USER,PASS);
    if(isset($_POST['sei'])){
        $password=$_POST['pass'];
        //会員情報変更
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
                    'pass' => $password
                ];
            }
        }
        echo '<div id="mannaka">';
        echo '<p font color="red">お客様情報を更新しました。<p>';
        echo '</div>';
        echo '<br>';
    }
    $count;
    $sql=$pdo->prepare('select * from Members where member_code=?');
    $sql->execute([$_SESSION['customer']['code']]);
    foreach($sql as $row){
        echo '<input type="hidden" name="sei" value="',$row['family_name'],'">';
        echo '<input type="hidden" name="mei" value="',$row['first_name'],'">';
        echo '<input type="hidden" name="seikana" value="',$row['family_name_kana'],'">';
        echo '<input type="hidden" name="meikana" value="',$row['first_name_kana'],'">';
        echo '<input type="hidden" name="zipcode" value="',$row['post_code'],'">';
        echo '<input type="hidden" name="prefecture" value="',$row['prefecture'],'">';
        echo '<input type="hidden" name="city" value="',$row['city'],'">';
        echo '<input type="hidden" name="address" value="',$row['section'],'">';
        echo '<input type="hidden" name="bill" value="',$row['building'],'">';
        echo '<input type="hidden" name="tel" value="',$row['phone'],'">';
        echo '<input type="hidden" name="mail" value="',$row['email'],'">';
        echo '<input type="hidden" name="pass" value="',$_SESSION['customer']['pass'],'">';
        $count = (strlen($_SESSION['customer']['pass']));
        $pass = str_repeat("*", $count);
        echo '<table align="center">';
        //名前
        echo '<tr><td>';
        echo '<p align="center"><div id="simei">　　',$row['family_name'],'　',$row['first_name'],'(',$row['family_name_kana'],'　',$row['first_name_kana'],')</div></p>';
        echo '</td></tr>';
        //郵便番号
        echo '<tr><td>';
        echo '<p align="center"><div id="yuubin">　　',$row['post_code'],'</div></p>';
        echo '</td></tr>';
        //住所
        echo '<tr><td>';
        echo '<p align="center">',$row['prefecture'],'　',$row['city'],'　',$row['section'],'<br>';
        echo $row['building'],'</p>';
        echo '</tr></td>';
        //電話番号
        echo '<tr><td>';
        echo '<p align="center"><div id="tell">　　',$row['phone'],'</div></p>';
        echo '</tr></td>';
        //メールアドレス
        echo '<tr><td>';
        echo '<p align="center"><div id="meru2">　　',$row['email'],'</div></p>';
        echo '</tr></td>';
        //パスワード
        echo '<tr><td>';
        echo '<p align="center"><div id="pas2">　　',$pass,'</div></p>';
        echo '</tr></td>';
        echo '</table>';
    }
    echo '<br>';
    echo '<p><button class="ao" type="submit" href="member_change.php">会員情報の変更</button></p>';
    echo '</form>';
    require 'footer.php';
}
else{
    echo 'このページを表示できません';
}
?>