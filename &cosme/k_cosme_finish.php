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
</head>
<body>
    <h3>&cosme</h3>
    <div id="hr2"><hr color="black"></div>
    <div id="center">
    <h3>商品登録完了</h3>
    </div>
    <p><font color="FF0000">商品登録が完了しました</font></p>
    <form action="k_home.php" method="post">
        <button type="submit">ホームへ</button>
    </form>
    <form action="k_cosme_new_php?page=0" method="post">
    <button type="submit">続けて登録</button>
    </form>
</body>
</html>