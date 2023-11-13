<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログアウト画面</title>
</head>
<body>
    <h3>&cosme</h3>
    <hr>
    <?php
if(isset($_SESSION['customer'])){
    unset($_SESSION['customer']);
    echo 'ログアウトしました。';
    echo '<form action="login.php" method="post">';
    echo '<button class="ao">ログイン画面へ戻る</button>';
    echo '</form>';//変更
   
}else{
    echo 'すでにログアウトしています。';
    echo '<form action="login.php" method="post">';
    echo '<button class="ao">ログイン画面へ戻る</button>';
    echo '</form>';
}
?>

<?php require 'footer.php'; ?>

    
</body>
</html>
