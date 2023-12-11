<?php
session_start();
if(empty($_SESSION['admin'])){
    header('Location: ./k_error.php');
    exit();
}
?>
<?php require 'db_connect.php'; ?>
<?php
$pdo=new PDO($connect, USER, PASS);
$detailup=$pdo->prepare('insert into Cosmetics values(null, ?, ?, ?, ?, ?, ?, ?, ?, ?, current_date)');
$detailup->execute([$_POST['cosme_name'],$_POST['color_name'],$_POST['group_id'],$_POST['colorSelect'],$_POST['brandSelect'],$_POST['categorySelect'],$_POST['cosme_detail'],$_POST['price'],$_POST['file']]);
?>
<?php require 'k_header.php'; ?>
<h3>&cosme</h3>
<div id="center"><h2>商品登録完了</h2>
<div id="hr2"><hr color="black"></div>
<p><font color="FF0000">商品登録が完了しました。</font></p>
<form action="k_home.php" method="post">
    <button type="submit" class="ao" style="width: 300px;height: 30px;">ホームへ</button></p>
</form>
    <form action="k_cosme_new.php" method="post">
        <button type="submit" class="grey" style="width: 300px;height: 30px;">続けて登録</button>
    </form>
</div>
<?php require 'footer.php'; ?>