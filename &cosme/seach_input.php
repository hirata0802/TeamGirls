<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>seach</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
</head>
<body>
    <?php require 'menu.php'; ?>
    <form action="seach_output.php" method="post">
        <input type="text" name="keyword" placeholder="キーワードで検索">
        <button type="submit" class="fas fa-search"></button>
    <div id="seach">
        <table style="font-size:5pt">
            <tr>
                <th colspan=3>カテゴリー</th>
            </tr>
            <?php
            echo '<tr>';
                echo '<td><input type="image" src="image/eye.jpg" alt="アイシャドウ" width="60px"><br>アイシャドウ</td>';
                echo '<td><input type="image" src="image/eyeliner.jpg" alt="アイライナー" width="60px"><br>アイライナー</td>';
                echo '<td><input type="image" src="image/eyeliner.jpg" alt="アイライナー" width="60px"><br>アイライナー</td>';
            echo '</tr><tr>';
                echo '<td><input type="image" src="image/eye.jpg" alt="アイシャドウ" width="60px"><br>アイシャドウ</td>';
                echo '<td><input type="image" src="image/eyeliner.jpg" alt="アイライナー" width="60px"><br>アイライナー</td>';
                echo '<td><input type="image" src="image/eyeliner.jpg" alt="アイライナー" width="60px"><br>アイライナー</td>';
            echo '</tr>';
            ?>
        </table>
        <table style="font-size:5pt">
            <tr>
                <th colspan=3>ブランド</th>
            </tr>
            <?php
            echo '<tr>';
                echo '<td><input type="image" src="image/canmake.jpg" alt="キャンメイク" width="60px"><br>キャンメイク</td>';
                echo '<td><input type="image" src="image/canmake.jpg" alt="キャンメイク" width="60px"><br>キャンメイク</td>';
                echo '<td><input type="image" src="image/canmake.jpg" alt="キャンメイク" width="60px"><br>キャンメイク</td>';
            echo '</tr><tr>';
                echo '<td><input type="image" src="image/canmake.jpg" alt="キャンメイク" width="60px"><br>キャンメイク</td>';
                echo '<td><input type="image" src="image/canmake.jpg" alt="キャンメイク" width="60px"><br>キャンメイク</td>';
                echo '<td><input type="image" src="image/canmake.jpg" alt="キャンメイク" width="60px"><br>キャンメイク</td>';
            echo '</tr>';
            ?>
        </table>
    </div>
    </form>
</body>
</html>
