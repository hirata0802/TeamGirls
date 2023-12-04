<?php require 'db_connect.php'; ?>
<?php
$errormsg="";
if($_GET['page']==1){
    $pdo = new PDO($connect, USER, PASS);
    $sql = $pdo -> prepare('select * from Cosmetics where cosme_name = ? and color_name');
    $sql->execute([$_POST['cosme_name'],$_POST['color_name']]);
    if(!empty($sql->fetchAll())){
        header('Location: ./k_cosme_check.php');
        exit();
    }else{
        $errormsg="すでに登録された商品です";
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品登録画面</title>
</head>
<body>
<h3>&cosme</h3>
<div id="hr2"><hr color="black"></div>
    

<form action="k_cosme_new.php&page=1" method="post">
    <?php

    $pdo = new PDO($connect, USER, PASS);
    echo '<div id="logtitle">';
    echo '<h2>商品登録</h2>';
    echo '</div>';
    echo '<p><input type="text" name="cosme_name" placeholder="商品名" required></p>';
    echo '<p><input type="text" name="color_name" placeholder="カラー名" required>　';
    $color=[1=>'レッド', 2=>'オレンジ', 3=>'ピンク', 4=>'ベージュ', 5=>'ホワイト', 6=>'ブラウン', 7=>'ブラック', 8=>'シルバー', 9=>'ゴールド', 10=>'その他'];
    echo '<select name="colorSelect">';
        echo '<option value="0" selected hidden>カラーID</option>';
        foreach($color as $key => $value){
            echo '<option value="',$key,'">',$value,'</option>';
        }
    echo '</select></p>';

    $sql=$pdo->query('select * from Brands');
    echo '<p><select name="brandSelect">';
        echo '<option value="0" selected hidden>ブランド名</option>';
        foreach($sql as $row){
            echo '<option value="',$row['brand_id'],'">',$row['brand_name'],'</option>';
        }
    echo '</select>　';

    $sql=$pdo->query('select * from Categories');
    echo '<select name="categorySelect">';
        echo '<option value="0" selected hidden>カテゴリー</option>';
        foreach($sql as $row){
            echo '<option value="',$row['category_id'],'">',$row['category_name'],'</option>';
        }
    echo '</select></p>';
    echo '<p><textarea name="cosme_detail" placeholder="商品説明" rows="5" cols="40" maxlength="200" title="200文字以内で入力してください" required></textarea></p>';
    echo '<p><input type="number" name="price" placeholder="価格" min=0 required></p>';
    echo '<input type="file" name="file">';
    echo '<br>',$errormsg;
    
    ?>
    <br>
        <p><button type="submit" class="ao">確認</button></p>
    </form>
    <button onclick="location.href='k_home.php'" class="grey">戻る</button>
    <script src="./js/jquery-3.7.0.min.js"></script>
    <script src="./js/app.js"></script>
</body>
</html>
<?php require 'footer.php'; ?>