<?php require 'db_connect.php'; ?>
<?php
$errormsg="";
if($_GET['page']==1){
    $errormsg='すでに登録された商品です';
}else if($_GET['page']==2){
    $errormsg='カラーID,ブランド名,カテゴリーを選択してください';
}else if($_GET['page']==3){
    $errormsg='ファイルのアップロードに失敗しました';
}
if(isset($_POST['back'])){
    $path1=$_POST['file'];
    if(unlink($path1)){
        $errormsg="";
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/k_style.css">
    <title>商品登録</title>
</head>
<body>
<h3>&cosme</h3>
<div id="center"><h2>商品登録</h2></div>
<div id="hr2"><hr color="black"></div>
    

<form action="k_cosme_check.php" method="post" enctype="multipart/form-data">
    <?php

    $pdo = new PDO($connect, USER, PASS);
    echo '<div id="center">';
    echo '<h2>商品登録</h2>';
    echo '</div>';
    echo '<div id="center">';
    echo '<p><input type="text" class="ao" style="width: 300px;height: 30px;" name="cosme_name" placeholder="商品名" required></p>';
    echo '</div>';
    echo '<br>';
    echo '<div id="center2">';
    echo '<p><input type="text" name="color_name" placeholder="カラー名" required>';
    $color=[1=>'レッド', 2=>'オレンジ', 3=>'ピンク', 4=>'ベージュ', 5=>'ホワイト', 6=>'ブラウン', 7=>'ブラック', 8=>'シルバー', 9=>'ゴールド', 10=>'その他'];
    echo '<select name="colorSelect">';
        echo '<option value="0" selected hidden>カラーID</option>';
        foreach($color as $key => $value){
            echo '<option value="',$key,'">',$value,'</option>';
        }
    echo '</select></p>';
    echo '</div>';

    echo '<div id="center">';
    $sql=$pdo->query('select * from Brands');
    echo '<p><select name="brandSelect">';
        echo '<option value="0" selected hidden>ブランド名</option>';
        foreach($sql as $row){
            echo '<option value="',$row['brand_id'],'">',$row['brand_name'],'</option>';
        }
    echo '</select>';

    $sql=$pdo->query('select * from Categories');
    echo '<select name="categorySelect">';
        echo '<option value="0" selected hidden>カテゴリー</option>';
        foreach($sql as $row){
            echo '<option value="',$row['category_id'],'">',$row['category_name'],'</option>';
        }
    echo '</select></p>';
    echo '<p><textarea name="cosme_detail" placeholder="商品説明" rows="5" cols="40" maxlength="200" title="200文字以内で入力してください" required></textarea></p>';
    echo '<p><input type="number" class="ao" style="width: 300px;height: 30px;" name="cosme_name" placeholder="価格" min=0 required></p>';
    echo '<input type="file" name="file" accept=".jpg" required>';
    echo '<br><font color="FF0000">',$errormsg,'</font>';
    echo '</div>';
    ?>
    <br><button type="submit" class="ao">確認</button><br>
    <button onclick="location.href='k_home.php'" class="grey">戻る</button>
</form>
</body>
</html>
<?php require 'footer.php'; ?>