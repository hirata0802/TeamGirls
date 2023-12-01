<?php session_start(); ?>
<?php require 'header.php'; ?>
    <h3>&cosme</h3>
<div id="hr2"><hr color="black"></div>
    

    <form action="k_cosme_check.php" method="post">
        <?php
        unset($_SESSION['toroku']);
    $cosme_id=$cosme_name=$color_name=$group_id=$color_id=$brand_id=$category_id=$cosme_detail=$price=$image_path=$creation_date=$error='';
    if(isset($_SESSION['cosme'])){
        $cosme_id=$_SESSION['cosme']['id'];
        $cosme_name=$_SESSION['cosme']['name'];
        $color_name=$_SESSION['cosme']['color_name'];
        $group_id=$_SESSION['cosme']['group_id'];
        $color_id=$_SESSION['cosme']['color_id'];
        $brand_id=$_SESSION['cosme']['brand_id'];
        $category_id=$_SESSION['cosme']['category_id'];
        $cosme_detail=$_SESSION['cosme']['detail'];
        $price=$_SESSION['cosme']['price'];
        $image_path=$_SESSION['cosme']['image'];
        $creation_date=$_SESSION['cosme']['creation'];
        $error='<font color="FF0000">商品が既に登録されています。</font>';

    }
      echo '<div id="logtitle">';
      echo '<h2>商品登録</h2>';
      echo '</div>';
      if(!isset($cosme_name&&$color_name)){
          echo '<p><div id="mannaka">', $error, '</p></div>';
      }
      echo '<div id="simei">';
      echo '<input type="text" style="width: 100px;height: 30px;" name="sei" placeholder="氏名（姓）" value="',$sei,'" required>';
      echo '<input type="text" style="width: 100px;height: 30px;" name="mei" placeholder="氏名（名）" value="',$mei,'" required>';
      echo '</div>';
      echo '<div id="mannaka">';
      echo '<p><input type="text" style="width: 125px;height: 30px;" name="seikana" placeholder="かな（せい）" value="',$seikana,'" required>';
      echo '<input type="text" style="width: 125px;height: 30px;" name="meikana" placeholder="かな（めい）" value="',$meikana,'" required></p>';
      echo '<div id="toroku0">';
      echo '<p><input type="text" style="width: 260px;height: 30px;" name="nickname" placeholder="ニックネーム" value="',$nickname,'" ></p>';
      echo '</div>';
      echo '<div id="yuubin">';
      echo '<input type="text" style="width: 240px;height: 27px;" name="zipcode" id="zipcode" placeholder="郵便番号" value="',$zipcode,'" required>';
      echo '</div>';
      //↓検索ボタンで住所自動入力
      echo ' <div id="kennsaku">';
      echo '<button type="button" class="ao" id="btn">検索</button></p>';
      echo '</div>';

      echo '<div id="toroku1">';
      echo '<p><input type="text" name="prefecture" id="prefecture" placeholder="都道府県" value="',$prefecture,'" required></p>';
      echo '<p><input type="text" name="city" id="city" placeholder="市区町村" value="',$city,'" required></p>';
      echo '<p><input type="text" name="address" id="address" placeholder="番地" value="',$address,'" required></p>';
      echo '<p><input type="text" name="bill" placeholder="マンション・ビル名" value="',$bill,'" ></p>';
      echo '</div>';
      echo '<div id="tell">';
      echo '<input type="tel" style="width: 240px;height: 27px;" name="tel" maxlength="11" pattern="^[0-9]+$" placeholder="電話番号" value="',$tel,'" required>';
      echo '</div>';
      echo '<br>';
      echo '<div id="meru2">';
      echo '<input type="email" style="width: 240px;height: 27px;" name="mail" placeholder="メールアドレス" required>';
      echo '</div>';
      echo '<br>';
      echo '<div id="pas2">';
      echo '<input type="password" style="width: 240px;height: 27px;" name="pass" placeholder="パスワード" pattern="^([a-zA-Z0-9]{6,})$" title="半角英数字6文字以上で入力ください" value="',$pass,'" required>';
      echo '</div>';
    ?>
    <br>
    <br>
        <p><button type="submit" class="ao">確認</button></p>
    </form>
    <script src="./js/jquery-3.7.0.min.js"></script>
    <script src="./js/app.js"></script>
</body>
</html>
<?php require 'footer.php'; ?>
