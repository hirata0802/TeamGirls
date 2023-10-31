<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員情報登録確認画面</title>
</head>
<body>
    <h3>&cosme</h3>
    <hr>
    <h2>登録確認</h2>
    <form action="member_finish.php" method="post">
        <p><input type="text" name="sei" placeholder="氏名（姓）" readonly><input type="text" name="mei" placeholder="氏名（名）" readonly></p>
        <p><input type="text" name="seikana" placeholder="かな（せい）" readonly><input type="text" name="meikana" placeholder="かな（めい）" readonly></p>
        <p><input type="text" name="nikkuname" placeholder="ニックネーム" readonly></p>
        <p><input type="text" name="yubin" placeholder="郵便番号" readonly>
        <p><input type="text" name="ken" placeholder="都道府県" readonly></p>
        <p><input type="text" name="mura" placeholder="市区町村" readonly></p>
        <p><input type="text" name="banti" placeholder="番地" readonly></p>
        <p><input type="text" name="bill" placeholder="マンション・ビル名" readonly></p>
        <p><input type="text" name="tel" placeholder="電話番号"readonly></p>
        <p><input type="text" name="meil" placeholder="メールアドレス"readonly></p>
        <p><input type="text" name="pass" placeholder="パスワード"readonly></p>
    </form>
    <div class="grey"><button onclick="location.href='member_new.html'">変更</button></div></p>
    <div class="ao"><button onclick="location.href='member_finish.html'">新規登録</button></div></p>
</body>
</html>