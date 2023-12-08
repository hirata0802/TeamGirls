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
$sql=$pdo->prepare('select group_id from Cosmetics where cosme_name = ?');
$sql->execute([$_POST['cosme_name']]);
$rowcount=$sql->rowCount();
if($rowcount>=1){
    $group_id=$sql->fetchColumn();
    $rowcount++;
    $name=$group_id.'_'.$rowcount.'.jpg';
    $targetDir="image/";
    $fileName=basename($name);
    $targetFilePath=$targetDir.$fileName;
}else{
    $sql2=$pdo->query('select max(group_id) from Cosmetics');
    $group_id=$sql2->fetchColumn();
    $group_id++;
    $name=$group_id.'_1.jpg';
    $targetDir="image/";
    $fileName=basename($name);
    $targetFilePath=$targetDir.$fileName;
}
if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFilePath)){
    $key=$_POST['colorSelect'];
}else{
    header('Location: ./k_cosme_new.php?page=3');
    exit();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/k_style.css">
    <title>商品登録確認</title>
</head>
<body>
<h3>&cosme</h3>
<div id="center"><h2>商品登録確認</h2></div>
<div id="hr2"><hr color="black"></div>
<div id="center">
    <h2>商品登録確認</h2>
</div>
    <form action="k_cosme_finish.php" method="post" enctype="multipart/form-data">
        <?php
        $pdo=new PDO($connect, USER, PASS);
        $brand=$pdo->prepare('select brand_name from Brands where brand_id = ?');
        $brand->execute([$_POST['brandSelect']]);
        $brand_name=$brand->fetchColumn();
        $category=$pdo->prepare('select category_name from Categories where category_id = ?');
        $category->execute([$_POST['categorySelect']]);
        $category_name=$category->fetchColumn();
        echo '<p><input type="text" name="cosme_name" value="',$_POST['cosme_name'],'" readonly></p>';
        echo '<p><input type="text" name="color_name" value="',$_POST['color_name'],'" readonly>　';
        $color=[1=>'レッド', 2=>'オレンジ', 3=>'ピンク', 4=>'ベージュ', 5=>'ホワイト', 6=>'ブラウン', 7=>'ブラック', 8=>'シルバー', 9=>'ゴールド', 10=>'その他'];
        $key=$_POST['colorSelect'];
        echo '<input type="text" value="',$color[$key],'" readonly></p>';
        echo '<p><input type="text" value="',$brand_name,'" readonly>　';
        echo '<input type="text" value="',$category_name,'" readonly></p>';
        echo '<p><textarea name="cosme_detail" placeholder="',$_POST['cosme_detail'],'" rows="5" cols="40" readonly></textarea></p>';
        echo '<p><input type="number" name="price" value="',$_POST['price'],'"></p>';
        echo '<input type="text" name="file" value="',$targetFilePath,'">';
        echo '<input type="hidden" name="colorSelect" value="',$key,'">';
        echo '<input type="hidden" name="group_id" value="',$group_id,'">';
        echo '<input type="hidden" name="brandSelect" value="',$_POST['brandSelect'],'">';
        echo '<input type="hidden" name="categorySelect" value="',$_POST['categorySelect'],'">';
        echo '<button type="submit" class="ao">商品新規登録</button><br>';
        echo '</form>';
        echo '<form action="k_cosme_new.php?page=0" method="post">';
        echo '<input type="hidden" name="file" value="',$targetFilePath,'">'
        ?>
        <button type="submit" class="grey" name="back">変更</button>
</form>
</body>
</html>
<?php require 'footer.php'; ?>