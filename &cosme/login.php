<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン画面</title>
</head>
<body>
    <h3>&cosme</h3>
    <hr>
    <h2>ログイン</h2>
    <form action="home.php" method="post">
        <p><input type="text" name="mail" placeholder="メールアドレス"></p>
        <p><input type="password" name="pass" placeholder="パスワード"></p>
        <p><button type="submit">ログイン</button></p>
    </form>
    <hr>
    <p>アカウントをお持ちでない方はこちら</p>
    <a href="member_new.php">新規会員登録</a>
</body>
</html>