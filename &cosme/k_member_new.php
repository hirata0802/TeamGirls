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
            $error='<font color="FF0000">メールアドレスが既に登録されています。</font>';
        }
    }
    
    echo '<p><div id="center">', $error, '</p></div>';
    echo '<div id="center">';
    echo '<input type="email" style="width: 400px;height: 30px;" name="admin_email" placeholder="メールアドレス" required>';
    echo '</div>';
    echo '<br>';
    echo '<br>';
    echo '<div id="center">';
    echo '<input type="password" style="width: 400px;height: 30px;" name="admin_password" placeholder="パスワード" pattern="^([a-zA-Z0-9]{6,})$" title="半角英数字6文字以上で入力ください" value="',$admin_password,'" required>';
    echo '</div>';
?>
    <br><br>
    <p><button type="submit" class="ao">確認</button></p>
</form>
<form action="k_home.php" method="post">
    <button type="submit">ホームへ</button>
</form>
<?php require 'footer.php'; ?>