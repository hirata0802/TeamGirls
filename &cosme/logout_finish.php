<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>ログイン画面</title>
</head>
<body>
    <h3>&cosme</h3>
    <hr color="black">
    <?php
if(isset($_SESSION['customer'])){
    unset($_SESSION['customer']);
    echo '<div id="logtitle3">';
    echo 'ログアウトしました。';
    echo '</div>';
    echo '<form action="login.php" method="post">';
    echo '<hr width="250">';
    echo '<button class="ao">ログイン画面へ戻る</button>';
    echo '</form>';//変更
   
}else{
    echo '<div id="logtitle3">';
    echo 'すでにログアウトしています。';
    echo '</div>';
    echo '<form action="login.php" method="post">';
    echo '<hr width="250">';
    echo '<button class="ao">ログイン画面へ戻る</button>';
    echo '</form>';
}
?>

<?php require 'footer.php'; ?>

    
</body>
</html>
