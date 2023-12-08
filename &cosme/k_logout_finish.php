<?php session_start(); ?>
<?php require 'header.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<link rel="stylesheet" href="css/k_style.css">
    <title>管理者ログアウト完了画面</title>
</head>
<body>
    <h3>&cosme</h3>
    <div id="center"><h2>ログアウト完了</h2></div>
    <div id="center"><hr color="black"></div>
    <?php
if(isset($_SESSION['admins'])){
    unset($_SESSION['admins']);
    echo '<div id="center">';
    echo '<h3>ログアウトしました。</h3>';
    echo '<hr width="250">';
    echo '</div>';
    echo '<form action="k_login.php" method="post">';
    echo '<button class="ao">ログイン画面へ戻る</button>';
    echo '</form>';//変更
   
}else{
    echo '<div id="logtitle3">';
    echo '<h3>すでにログアウトしています。</h3>';
    echo '<hr width="250">';
    echo '</div>';
    echo '<form action="k_login.php" method="post">';
    echo '<button class="ao">ログイン画面へ戻る</button>';
    echo '</form>';
}
?>

<?php require 'footer.php'; ?>

    
</body>
</html>
