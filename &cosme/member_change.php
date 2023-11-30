<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php require 'header.php'; ?>
<h3>&cosme</h3>
    <hr color="black">
    <!--個人情報画面に遷移-->
    
    <div id="logtitle"><h2>会員情報変更</h2></div>
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
       echo '<div id="simei">';
       echo '<input type="text" style="width: 120px;height: 30px;" name="sei" value="',$row['family_name'],'" required>';
       echo '<input type="text" style="width: 120px;height: 30px;" name="mei" value="',$row['first_name'],'" required>';
       echo '</div>';
       echo '<div id="mannaka">';
       echo '<p><input type="text" style="width: 125px;height: 30px;" name="seikana" value="',$row['family_name_kana'],'" required>';
       echo '<input type="text" style="width: 125px;height: 30px;" name="meikana" value="',$row['first_name_kana'],'" required>'</p>;
       echo '</div>';
       echo '<div id="yuubin">';
       echo '<input type="text" style="width: 240px;height: 27px;" name="zipcode" id="zipcode" value="',$row['post_code'],'" requiredy>';
       echo '</div>';
       echo ' <div id="kennsaku">';
       echo '<button type="button" class="ao" id="btn">検索</button></p>';
       echo '</div>';

       echo '<div id="toroku1">';
      echo '<p><input type="text" name="prefecture" id="prefecture" value="',$row['prefecture'],'" required></p>';
      echo '<p><input type="text" name="city" id="city" value="',$row['city'],'" required></p>';
      echo '<p><input type="text" name="address" id="address" value="',$row['section'],'" required></p>';
      echo '<p><input type="text" name="bill" value="',$row['building'],'" ></p>';
      echo '</div>';

       echo '<div id="tell">';
       echo '<p><input type="tel" style="width: 240px;height: 27px;" name="tel" maxlength="11" pattern="^[0-9]+$" value="',$row['phone'],'" required>';
       echo '</div>';
       echo '<br>';
       echo '<div id="meru2">';
       echo '<p><input type="email" style="width: 240px;height: 27px;" name="mail" value="',$row['email'],'" required>';
       echo '</div>';
       echo '<br>';
       echo '<div id="pas2">';
       echo '<p><input type="password" style="width: 240px;height: 27px;" name="pass" value="',$_SESSION['customer']['pass'],'" required>';
       echo '</div>';
       
    }

    

   echo '<p><button class="ao" type="submit" href="member_change.php">変更</button></p>';
        ?>
        </form>
        <br>
        <script src="./js/jquery-3.7.0.min.js"></script>
    <script src="./js/app.js"></script>
    <div class="modoru"><button onclick="history.back()">戻る</button></div>
</body>
</html>