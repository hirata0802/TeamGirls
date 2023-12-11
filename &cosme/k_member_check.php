<?php
session_start();
if(empty($_SESSION['admin'])){
    header('Location: ./k_error.php');
    exit();
}
?>
<?php require 'db_connect.php'; ?>
<?php
 $_SESSION['newAdmin'] = [
    'mail' => $_POST['admin_email'],
    'pass' => $_POST['admin_password']
];
$pdo=new PDO($connect,USER,PASS);
$sql=$pdo->prepare('select * from Admins where admin_email=?');
$sql->execute([$_POST['admin_email']]);
if(!empty($sql->fetchAll())){
    $_SESSION['newAdmin']['mail']=null;
    header('Location: ./k_member_new.php');
    exit();
}
echo '<link rel="stylesheet" href="css/k_style.css">';
?>
<?php require 'k_header.php'; ?>
<h3>&cosme</h3>
<div id="hr2"><hr color="black"></div>
<div id="center"><h2>登録確認</h2></div>
    <form action="k_member_finish.php" method="post" id="next">
        <?php
        echo '<div id="center">';
        echo '<input type="text" style="width: 240px;height: 27x;" name="admin_email" value="',$_POST['admin_email'], '" placeholder="',$_POST['admin_email'],'" readonly>';
        echo '</div>';
        echo '<br>';
        echo '<div id="center">';
        echo '<input type="text" style="width: 240px;height: 27x;" name="admin_password" value="',$_POST['admin_password'], '" placeholder="',$_POST['admin_password'],'" readonly>';
        echo '</div>';
        ?>
    </form>
    <br>
    <button onclick="history.back()" class="grey" style="width: 300px;height: 30px;">変更</button></p><br>
    <button type="submit" form="next" class="ao" style="width: 300px;height: 30px;">新規登録</button></p>
</body>
</html>
<?php require 'footer.php'; ?>