<?php session_start(); ?>
<?php
if(!empty($_SESSION['customer'])){
    require 'header.php';
    require 'db_connect.php';
    echo '<h3>&cosme</h3>';
    echo '<hr color="black">';
    
    echo '<div id="logtitle"><h2>会員情報変更</h2></div>';
    echo '<form action="member_display.php" method="post">';
    
    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->prepare('select * from Members where member_code=?');
    $sql->execute([$_SESSION['customer']['code']]);
    foreach($sql as $row){
        echo '<div id="mannaka">';
        echo '<input type="text" style="width: 125px;height: 30px;" name="sei" value="',$row['family_name'],'" placeholder="氏名（姓）" required>';
        echo '<input type="text" style="width: 125px;height: 30px;" name="mei" value="',$row['first_name'],'" placeholder="氏名（名）" required>';
        echo '<p><input type="text" style="width: 125px;height: 30px;" name="seikana" value="',$row['family_name_kana'],'" placeholder="しめい（せい）" required>';
        echo '<input type="text" style="width: 125px;height: 30px;" name="meikana" value="',$row['first_name_kana'],'" placeholder="しめい（めい）" required></p>';
        echo '<input type="text" style="width: 255px;height: 27px;" name="zipcode" id="zipcode" value="',$row['post_code'],'" placeholder="郵便番号" requiredy>';
        echo '</div>';
        echo ' <div id="kennsaku">';
        echo '<button type="button" class="ao" id="btn">検索</button></p>';
        echo '</div>';
        
        echo '<div id="toroku1">';
        echo '<p><input type="text" name="prefecture" id="prefecture" value="',$row['prefecture'],'" placeholder="都道府県" required></p>';
        echo '<p><input type="text" name="city" id="city" value="',$row['city'],'" placeholder="市区町村" required></p>';
        echo '<p><input type="text" name="address" id="address" value="',$row['section'],'" placeholder="番地" required></p>';
        echo '<p><input type="text" name="bill" value="',$row['building'],'" placeholder="マンション・ビル名"></p>';
        echo '</div>';
        
        echo '<div id="mannaka">';
        echo '<p><input type="tel" style="width: 255px;height: 27px;" name="tel" maxlength="11" pattern="^[0-9]+$" value="',$row['phone'],'" placeholder="電話番号" required>';
        echo '<br>';
        echo '<p><input type="email" style="width: 255px;height: 27px;" name="mail" value="',$row['email'],'" placeholder="メールアドレス" required>';
        echo '<br>';
        echo '<p><input type="password" style="width: 255px;height: 27px;" name="pass" value="',$_SESSION['customer']['pass'],'" placeholder="パスワード" required>';
        echo '</div>';
        
    }
    
    
    echo '<br>';
    echo '<p><button class="ao" type="submit" href="member_change.php">変更</button></p>';
    echo '</form>';
    echo '<script src="./js/jquery-3.7.0.min.js"></script>';
    echo '<script src="./js/app.js"></script>';
    echo '<button type="button" class="grey" onclick="history.back()">戻る</button>';
    require 'footer.php';
}
else{
    echo 'このページを表示できません';
}
?>