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
    <form action="member_finish.php" method="post" id="next">
        <?php
        echo '<p><input type="text" name="sei" placeholder="',$_POST['sei'],'" readonly>';
        echo '<input type="text" name="mei" placeholder="',$_POST['mei'],'" readonly></p>';
        echo '<p><input type="text" name="seikana" placeholder="',$_POST['seikana'],'" readonly>';
        echo '<input type="text" name="meikana" placeholder="',$_POST['meikana'],'" readonly></p>';
        echo '<p><input type="text" name="nickname" placeholder="',$_POST['nickname'],'" readonly></p>';
        echo '<p><input type="text" name="zipcode" placeholder="',$_POST['zipcode'],'" readonly>';
        echo '<p><input type="text" name="prefecture" placeholder="',$_POST['prefecture'],'" readonly></p>';
        echo '<p><input type="text" name="city" placeholder="',$_POST['city'],'" readonly></p>';
        echo '<p><input type="text" name="address" placeholder="',$_POST['address'],'" readonly></p>';
        echo '<p><input type="text" name="bill" placeholder="',$_POST['bill'],'" readonly></p>';
        echo '<p><input type="text" name="tel" placeholder="',$_POST['tel'],'" readonly></p>';
        echo '<p><input type="text" name="mail" placeholder="',$_POST['mail'],'" readonly></p>';
        echo '<p><input type="text" name="pass" placeholder="',$_POST['pass'],'" readonly></p>';
        ?>
    </form>
    <button onclick="history.back()" class="grey">変更</button></p>
    <button type="submit" form="next" class="ao">新規登録</button></p>
</body>
</html>