<?php session_start(); ?>
<?php require 'k_header.php'; ?>
<h3>&cosme</h3>
    <div id="center"><h2>ログアウト完了</h2></div>
    <div id="center"><hr color="black"></div>
<?php
if(isset($_SESSION['admin'])){
    unset($_SESSION['admin']);
    echo '<div id="center">';
    echo '<h3>ログアウトしました。</h3>';
    echo '<hr width="250">';
    echo '</div>';
    echo '<form action="k_login.php" method="post">';
    echo '<button class="next">ログイン画面へ戻る</button>';
    echo '</form>';   
}else{
    echo '<div id="center">';
    echo '<h3>すでにログアウトしています。</h3>';
    echo '</div>';
    echo '<form action="k_login.php" method="post">';
    echo '<button class="next" style="width: 300px;height: 30px;">ログイン画面へ戻る</button>';
    echo '</form>';
}
?>
<?php require 'footer.php'; ?>