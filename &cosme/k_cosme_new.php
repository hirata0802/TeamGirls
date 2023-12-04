<!--<?php session_start(); ?> -->
<?php require 'header.php'; ?>
<?php require 'db_connect.php'; ?>
    <h3>&cosme</h3>
<div id="hr2"><hr color="black"></div>
    

<form action="k_cosme_check.php" method="post">
    <?php

    $pdo = new PDO($connect, USER, PASS);
    /*
    unset($_SESSION['toroku']);
    $cosme_id=$cosme_name=$color_name=$group_id=$color_id=$brand_id=$category_id=$cosme_detail=$price=$image_path=$creation_date=$error='';
    if(isset($_SESSION['cosme'])){
        $cosme_id=$_SESSION['cosme']['cosme_id'];
        $cosme_name=$_SESSION['cosme']['cosme_name'];
        $color_name=$_SESSION['cosme']['color_name'];
        $group_id=$_SESSION['cosme']['group_id'];
        $color_id=$_SESSION['cosme']['color_id'];
        $brand_id=$_SESSION['cosme']['brand_id'];
        $category_id=$_SESSION['cosme']['category_id'];
        $cosme_detail=$_SESSION['cosme']['cosme_detail'];
        $price=$_SESSION['cosme']['price'];
        $image_path=$_SESSION['cosme']['image_path'];
        $creation_date=$_SESSION['cosme']['creation_date'];
        $error='<font color="FF0000">商品が既に登録されています。</font>';

    }
    */
      echo '<div id="logtitle">';
      echo '<h2>商品登録</h2>';
      echo '</div>';
      if(!isset($cosme_name) && !isset($color_name)){
          echo '<p><div id="mannaka">', $error, '</p></div>';
      }
    
      echo '<input type="text" name="cosme_name" placeholder="商品名" value="',$cosme_name,'" required>';
      echo '<input type="text" name="color_name" placeholder="カラー名" value="',$color_name,'" required>';
            $color=[1=>'レッド', 2=>'オレンジ', 3=>'ピンク', 4=>'ベージュ', 5=>'ホワイト', 6=>'ブラウン', 7=>'ブラック', 8=>'シルバー', 9=>'ゴールド', 10=>'その他'];
                echo '<select name="colorSelect">';
                echo '<option value="" selected hidden>カラーID</option>';
                    foreach($color as $key => $value){
                            echo '<option value="',$key,'">',$value,'</option>';
                            }
                        echo '</select>';
                echo '</td>';

      $sql=$pdo->query('select * from Brands');
      echo '<select name="brandSelect">';
          echo '<option value="" selected hidden>ブランド名</option>';
          foreach($sql as $row){
              echo '<option value="',$row['brand_id'],'">',$row['brand_name'],'</option>';
          }
      echo '</select>';

    $sql=$pdo->query('select * from Categories');
      echo '<select name="categorySelect">';
          echo '<option value="" selected hidden>カテゴリー</option>';
          foreach($sql as $row){
              echo '<option value="',$row['category_id'],'">',$row['category_name'],'</option>';
          }
      echo '</select>';
      echo '<input type="text" name="cosme_detail" placeholder="商品説明" value="',$cosme_detail,'" required>';
      echo '<input type="number" name="price" placeholder="値段" min=0 value="',$price,'" required>';
      echo '<input type="file" name="file">';
    
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
