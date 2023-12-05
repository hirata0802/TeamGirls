<?php require 'db_connect.php'; ?>
<?php
$pdo=new PDO($connect, USER, PASS);
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
    $sql2=$pdo->query('select max(group_id) as max from Cosmetics');
    $group_id=mysqli_fetch_assoc($sql2);
    $name=$group_id['max'].'_1.jpg';
    $targetDir="image/";
    $fileName=basename($name);
    $targetFilePath=$targetDir.$fileName;
}
echo $targetFilePath;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品登録完了画面</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h3>&cosme</h3>
    <div id="hr2"><hr color="black"></div>
    <div id="logtitle">
    <h3>商品登録完了</h3>
    </div>
    <p><font color="FF0000">登録が完了しました</font></p>
    
    <button onclick="location.href='k_home.php'">ホームへ</button><br>
    <button onclick="location.href='k_cosme_new.php?page=0'">続けて登録</button>
</body>
</html>