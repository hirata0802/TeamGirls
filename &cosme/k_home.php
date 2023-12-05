<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者ホーム画面</title>
</head>
<body>
<h3>&cosme</h3>
<h2>管理者ホーム</h2>
    <div id="sen"><hr color="black"></div>
    <form action="k_seles.php">
        <button type="submit">売上管理</button>
    </form>

    <form action="k_cosme_new.php?page=0" method="post">
        <button type="submit">商品登録</button>
    </form>

    <form action="k_logout.php">
        <button type="submit">ログアウト</button>
    </form>
</body>
</html>