<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php require 'header.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員情報変更画面</title>
</head>
<body>
    <h3>&cosme</h3>
    <hr>
    <!--個人情報画面に遷移-->
    
        <h2>会員情報変更</h2>
        <form action="member_display.php" method="post">
        <?php
        //   $sei=$mei=$seikana=$meikana=$nickname=$zipcode=$prefecture=$city=$address=$bill=$tel=$mail=$pass=$error='';
          /*if(isset($_SESSION['members'])){
             $sei=$_SESSION['members']['sei'];
             $mei=$_SESSION['members']['mei'];
             $seikana=$_SESSION['members']['seikana'];
             $meikana=$_SESSION['members']['meikana'];
             $nickname=$_SESSION['members']['nickname'];
             $zipcode=$_SESSION['members']['zipcode'];
             $prefecture=$_SESSION['members']['prefecture'];
             $city=$_SESSION['members']['city'];
             $address=$_SESSION['members']['address'];
             $bill=$_SESSION['members']['bill'];
             $tel=$_SESSION['members']['tel'];
             $mail=$_SESSION['members']['mail'];
             $pass=$_SESSION['members']['pass'];
         }*/
        $pdo=new PDO($connect,USER,PASS);
        $sql=$pdo->prepare('select * from Members where member_code=?');
        $sql->execute([$_SESSION['customer']['code']]);
    foreach($sql as $row){
       echo '<p><input type="text" name="sei" value="',$row['family_name'],'" required>';
       echo '<p><input type="text" name="mei" value="',$row['first_name'],'" required>';
       echo '<p><input type="text" name="seikana" value="',$row['family_name_kana'],'" required>';
       echo '<p><input type="text" name="meikana" value="',$row['first_name_kana'],'" required>';
       echo '<p><input type="text" name="zipcode" value="',$row['post_code'],'" requiredy>';
       echo '<p><input type="text" name="address" value="',$row['address'],'" required>';
       echo '<p><input type="tel" name="tel" maxlength="11" pattern="^[0-9]+$" value="',$row['phone'],'" required>';
       echo '<p><input type="email" name="mail" value="',$row['email'],'" required>';
       echo '<p><input type="password" name="pass" value="',$_SESSION['customer']['pass'],'" required>';
       
    }

    

   echo '<p><button class="ao" type="submit" href="member_change.php">変更</button></p>';
        ?>
        </form>
    
    <div class="modoru"><button onclick="history.back()">戻る</button></div>
</body>
</html>