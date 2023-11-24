<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <title>&cosme</title>
    </head>
    <body>
    <?php require 'db_connect.php'; ?>
    <?php require 'menu.php'; ?>
    <h3>商品レビューを書く</h3>
    <?php
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('select * from Cosmetics where cosme_id = ?');
    $sql->execute([$_POST['Rnew']]);
    echo '<p>',$_POST['Rnew'],'</p>';
    /*<p>満足度
    <form action="review.html" method="post">
        <div class="rate-form">
            <input id="star5" type="radio" name="rate" value="5">
            <label for="star5">★</label>
            <input id="star4" type="radio" name="rate" value="4">
            <label for="star4">★</label>
            <input id="star3" type="radio" name="rate" value="3">
            <label for="star3">★</label>
            <input id="star2" type="radio" name="rate" value="2">
            <label for="star2">★</label>
            <input id="star1" type="radio" name="rate" value="1">
            <label for="star1">★</label>
        </div>
        </p>
        <p>表示名
            <input type="text" name="hyoji">
        </p>
        <p>レビュー本文
        <textarea name="honbun" cols="30" rows="10"></textarea></p>
        <p>画像の追加（任意）
            <input type="file" name="pic">
        </p>
        <div class="ao"><button type="submit">投稿する</button></div>
    </form>*/
?>
</body>
</html>