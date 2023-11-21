<?php session_start(); ?>
<?php require 'header.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規会員登録画面</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h3>&cosme</h3>
    <hr color="black">
    <a href="f_login.html">＜戻る</a>
    

    <form action="member_check.php" method="post">
        <?php
        unset($_SESSION['customer']);
    $sei=$mei=$seikana=$meikana=$nickname=$zipcode=$prefecture=$city=$address=$bill=$tel=$mail=$pass=$error='';
    if(isset($_SESSION['members'])){
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
        $error='<font color="FF0000">メールアドレスが既に登録されています。</font>';
    }
      echo '<div id="logtitle">';
      echo '<h2>新規会員登録</h2>';
      echo '</div>';
      if(!isset($mail)){
          echo $error;
      }
      ?>

<div id="simei"><input type="text" style="width: 100px;height: 30px;" name="sei" placeholder="氏名（姓）" value="',$sei,'" required>
<input type="text" style="width: 100px;height: 30px;" name="mei" placeholder="氏名（名）" value="',$mei,'" required></div>
<div id="mannaka"><p><input type="text" style="width: 125px;height: 30px;" name="seikana" placeholder="かな（せい）" value="',$seikana,'" required>
<input type="text" style="width: 125px;height: 30px;" name="meikana" placeholder="かな（めい）" value="',$meikana,'" required></p>
<div id="toroku0"><p><input type="text" name="nickname" placeholder="ニックネーム" value="',$nickname,'" ></p></div>
<div id="yuubin"><input type="text" name="zipcode" id="zipcode" placeholder="郵便番号" value="',$zipcode,'" required></div>
      //↓検索ボタンで住所自動入力
<div id="kennsaku"><button type="button" class="ao" id="btn">検索</button></div>
<div id="toroku1">
<p><input type="text" name="prefecture" id="prefecture" placeholder="都道府県" value="',$prefecture,'" required></p>
<p><input type="text" name="city" id="city" placeholder="市区町村" value="',$city,'" required></p>
<p><input type="text" name="address" id="address" placeholder="番地" value="',$address,'" required></p>
<p><input type="text" name="bill" placeholder="マンション・ビル名" value="',$bill,'" ></p>
</div>
<div id="tell">
<input type="tel" style="width: 240px;height: 27px;" name="tel" maxlength="11" pattern="^[0-9]+$" placeholder="電話番号" value="',$tel,'" required></div><br>
<div id="meru2"> 
<input type="email" style="width: 240px;height: 27px;" name="mail" placeholder="メールアドレス" required></div><br>
<div id="pas2">
<input type="password" style="width: 240px;height: 27px;" name="pass" placeholder="パスワード" pattern="^([a-zA-Z0-9]{6,})$" title="半角英数字6文字以上で入力ください" value="',$pass,'" required></div>
<br>
<br>
        <p><button type="submit" class="ao">確認</button></p>
    </form>
    <script src="./js/jquery-3.7.0.min.js"></script>
    <script src="./js/app.js"></script>
</body>
</html>
<?php require 'footer.php'; ?>