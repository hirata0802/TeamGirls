<?php
session_start();
if(empty($_SESSION['admin'])){
    header('Location: ./k_error.php');
    exit();
}
unset($_SESSION['newAdmin']);
?>
<?php require 'k_header.php'; ?>
<h3>&cosme</h3>
    <div id="center"><h2>管理者ホーム</h2></div>
    <div id="center"><hr color="black"></div>
    <br><br>
    <form action="k_seles.php">
        <div id="center"><button type="submit" class="ao" style="width: 400px;height: 40px;">売上管理</button></p></div>
    </form>

    <form action="k_cosme_new.php?" method="post">
        <div id="center"><button type="submit" class="ao" style="width: 400px;height: 40px;">商品登録</button></p></div>
    </form>

    <form action="k_member_new.php" method="post">
        <div id="center"><button type="submit" class="ao" style="width: 400px;height: 40px;">管理者登録</button></p></div>
    </form>

    <form action="k_logout.php">
        <div id="center"><button type="submit" class="grey" style="width: 400px;height: 40px;">ログアウト</button></p></div>
    </form>
<?php require 'footer.php'; ?>