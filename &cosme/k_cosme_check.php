<?php require 'db_connect.php'; ?>
<?php
$pdo = new PDO($connect, USER, PASS);
$sql = $pdo -> prepare('select * from Cosmetics where cosme_name = ? and color_name = ?');
$sql->execute([$_POST['cosme_name'],$_POST['color_name']]);
if(!empty($sql->fetchAll())){
    header('Location: ./k_cosme_new.php?page=1');
    exit();
}else if($_POST['colorSelect']==0||$_POST['brandSelect']==0||$_POST['categorySelect']==0){
    header('Location: ./k_cosme_new.php?page=2');
    exit();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>商品登録確認</title>
</head>
<body>
<h3>&cosme</h3>
<div id="hr2"><hr color="black"></div>
<div id="logtitle">
    <h2>商品登録確認</h2>
</div>
    <form action="k_cosme_finish.php" method="post" enctype="multipart/form-data">
        <?php
        $pdo=new PDO($connect, USER, PASS);
        echo '<p><input type="text" name="cosme_name" value="',$_POST['cosme_name'],'" readonly></p>';
        echo '<p><input type="text" name="color_name" value="',$_POST['color_name'],'" readonly>　';
        $color=[1=>'レッド', 2=>'オレンジ', 3=>'ピンク', 4=>'ベージュ', 5=>'ホワイト', 6=>'ブラウン', 7=>'ブラック', 8=>'シルバー', 9=>'ゴールド', 10=>'その他'];
        $key=$_POST['colorSelect'];
        echo '<input type="text" name="colorSelect"  value="',$color[$key],'" readonly></p>';
        echo '<p><input type="text" name="brandSelect" value="',$_POST['brandSelect'],'" readonly>　';
        echo '<input type="text" name="categorySelect" value="',$_POST['categorySelect'],'" readonly></p>';
        echo '<p><textarea name="cosme_detail" placeholder="',$_POST['cosme_detail'],'" rows="5" cols="40" readonly></textarea></p>';
        echo '<p><input type="number" name="price" value="',$_POST['price'],'"></p>';
        echo '<input type="hidden" name="file" value="',$fileName,'">';
        
        ?>
    <button onclick="location.href='k_cosme_new.php?page=0'" class="grey">変更</button><br>
    <button type="submit" class="ao">商品新規登録</button>
</form>
</body>
</html>
<?php require 'footer.php'; ?>