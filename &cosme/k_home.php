<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/k_style.css">
    <title>管理者ホーム画面</title>
</head>
<body>
<h3>&cosme</h3>
<div id="center"><h2>管理者ホーム</h2></div>
    <div id="center"><hr color="black"></div>
    <form action="k_seles.php">
        <div id="center"><button type="submit">売上管理</button></div>
    </form>

    <form action="k_cosme_new.php?page=0" method="post">
    <div id="center"><button type="submit">商品登録</button></div>
    </form>

    <form action="k_logout.php">
    <div id="center"><button type="submit">ログアウト</button></div>
    </form>
</body>
</html>