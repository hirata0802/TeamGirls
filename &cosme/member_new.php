<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規会員登録画面</title>
</head>
<body>
    <h3>&cosme</h3>
    <hr>
    <button onclick="history.back()" class="back">戻る</button>
    <form action="member_check.php" method="post">
        <h2>新規会員登録</h2>
        <p><input type="text" name="sei" placeholder="氏名（姓）" required>
        <input type="text" name="mei" placeholder="氏名（名）" required></p>
        <p><input type="text" name="seikana" placeholder="かな（せい）" required>
        <input type="text" name="meikana" placeholder="かな（めい）" required></p>
        <p><input type="text" name="nickname" placeholder="ニックネーム"></p>
        <p><input type="text" name="zipcode" id="zipcode" placeholder="郵便番号" required>
        <!---↓検索ボタンで住所自動入力-->
        <button type="button" class="ao" id="btn">検索</button>

        <p><input type="text" name="prefecture" id="prefecture" placeholder="都道府県" required></p>
        <p><input type="text" name="city" id="city" placeholder="市区町村" required></p>
        <p><input type="text" name="address" id="address" placeholder="番地" required></p>
        <p><input type="text" name="bill" placeholder="マンション・ビル名"></p>
        <p><input type="tel" name="tel" placeholder="電話番号" required></p>
        <p><input type="email" name="mail" placeholder="メールアドレス" required></p>
        <p><input type="password" name="pass" placeholder="パスワード" pattern="^([a-zA-Z0-9]{6,})$" title="半角英数字6文字以上で入力ください" required></p>
    
        <button type="submit" class="ao">確認</button></p>
    </form>
    <script src="./js/jquery-3.7.0.min.js"></script>
    <script src="./js/app.js"></script>
</body>
</html>