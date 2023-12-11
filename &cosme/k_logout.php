<?php
session_start();
if(empty($_SESSION['admin'])){
    header('Location: ./k_error.php');
    exit();
}
?>
<?php require 'k_header.php'; ?>
<h3>&cosme</h3>
<div id="center"><h2>ログアウト</h2></div>
<hr color="black"><br>
<form action="k_logout_finish.php" method="post">
    <link rel="stylesheet" href="css/k_style.css">
    <div id="center"><h3>ログアウトしますか？</h3><br></div>
    <p><button class=".next" type="submit" style="width: 300px;height: 30px;">ログアウト</button></p></div>
    <br>
</form>
<form action="k_home.php" method="post">
    <button type="submit" class="return" style="width: 300px;height: 30px;">ホームへ</button>
</form>
<?php require 'footer.php'; ?>