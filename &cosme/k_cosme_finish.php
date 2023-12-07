<?php require 'db_connect.php'; ?>
<?php
$pdo=new PDO($connect, USER, PASS);
$detailup=$pdo->prepare('insert into Cosmetics values(null, ?, ?, ?, ?, ?, ?, ?, ?, ?, current_date)');
$detailup->execute([$_POST['cosme_name'],$_POST['color_name'],$_POST['group_id'],$_POST['colorSelect'],$_POST['brandSelect'],$_POST['categorySelect'],$_POST['cosme_detail'],$_POST['price'],$_POST['file']]);
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
    <p><font color="FF0000">商品登録が完了しました</font></p>
    <button type="button" onclick="location.href='k_home.php'">ホームへ</button><br>
    <button type="button" onclick="location.href='k_cosme_new.php?page=0'">続けて登録</button>
</body>
</html>