<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>seach</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
</head>
<body>
    <!--menu.phpをつなぐ-->
    <form action="seach_output.php" method="post">
        <input type="text" name="keyword" placeholder="キーワードで検索">
        <button type="submit" class="fas fa-search"></button>
    <h3>カテゴリ</h3>
    <div id="seach">
        <table style="font-size:5pt">
            <tr><!--3項目ずつ表示-->
                <td><input type="image" src="./image/eye.jpg" alt="アイシャドウ" width="60px"><br>
                    アイシャドウ</td>
                <td><input type="image" src="./image/eyeliner.jpg" alt="アイライナー" width="60px"><br>
                    アイライナー</td>
                <td><input type="image" src="./image/eyeliner.jpg" alt="アイライナー" width="60px"><br>
                    アイライナー</td>
            </tr>
            <tr>
                <td><input type="image" src="./image/eye.jpg" alt="アイシャドウ" width="60px"><br>
                    アイシャドウ</td>
                <td><input type="image" src="./image/eyeliner.jpg" alt="アイライナー" width="60px"><br>
                    アイライナー</td>
                <td><input type="image" src="./image/eyeliner.jpg" alt="アイライナー" width="60px"><br>
                    アイライナー</td>
            </tr>
        </table>
        <h3>ブランド</h3>
        <table style="font-size:5pt">
            <tr><!--3項目ずつ表示-->
                <td><input type="image" src="./image/canmake.jpg" alt="キャンメイク" width="60px"><br>
                キャンメイク</td>
                <td><input type="image" src="./image/canmake.jpg" alt="キャンメイク" width="60px"><br>
                    キャンメイク</td>
                <td><input type="image" src="./image/canmake.jpg" alt="キャンメイク" width="60px"><br>
                    キャンメイク</td>
            </tr>
        </table>
    </div>
    </form>
</body>
</html>
