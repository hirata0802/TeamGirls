<?php session_start(); ?>
<?php require 'header.php'; ?>
<h3>&cosme</h3>
<div id="sen"><hr color="black"></div>
<?php
if(isset($_SESSION['customer'])){
    unset($_SESSION['customer']);
    echo '<div id="logtitle3">';
    echo '<h3>ログアウトしました。</h3>';
    echo '<hr width="250">';
    echo '</div>';
    echo '<form action="login.php" method="post">';
    echo '<button class="ao">ログイン画面へ戻る</button>';
    echo '</form>';//変更
}else{
    echo '<div id="logtitle3">';
    echo '<h3>すでにログアウトしています。</h3>';
    echo '<hr width="250">';
    echo '</div>';
    echo '<form action="login.php" method="post">';
    echo '<button class="ao">ログイン画面へ戻る</button>';
    echo '</form>';
}
?>
<?php require 'footer.php'; ?>