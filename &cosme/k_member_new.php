<?php
session_start();
if(empty($_SESSION['admin'])){
    header('Location: ./k_error.php');
    exit();
}
?>
<?php require 'k_header.php'; ?>
<h3>&cosme</h3>
<div id="center"><h2>新規管理者登録</h2></div>
<div id="hr2"><hr color="black"></div>
    
<form action="k_member_check.php" method="post">
<?php
    $admin_email=$admin_password=$error='';
    if(isset($_SESSION['newAdmin'])){
        $admin_email=$_SESSION['newAdmin']['mail'];
        $admin_password=$_SESSION['newAdmin']['pass'];
        if(!isset($_SESSION['newAdmin']['mail'])){
            echo '<div id="center">';
            $error='<font color="FF0000">メールアドレスが既に登録されています。</font>';
            echo '</div>';
        }
    }
    
    echo '<div id="center"><p>', $error, '</p>';
    echo '<input type="email" name="admin_email" placeholder="メールアドレス" required>';
    echo '<br><br>';
    echo '<input type="password" name="admin_password" placeholder="パスワード" pattern="^([a-zA-Z0-9]{6,})$" title="半角英数字6文字以上で入力ください" value="',$admin_password,'" required>';
    echo '</div>';
?>
    <br>
    <div id="center">
    <p><button type="submit" class="next">確認</button></p></div>
</form>
<form action="k_home.php" method="post">
    <div id="center"><button type="submit" class="return">ホームへ</button></div>
</form>
<?php require 'footer.php'; ?>