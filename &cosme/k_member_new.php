<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<body>
<h3>&cosme</h3>
<div id="hr2"><hr color="black"></div>
    <a href="k_login.php">＜戻る</a>
    
    <form action="k_member_check.php" method="post">
        <?php
        unset($_SESSION['admins']);
    $admin_email=$admin_password=$error='';
    if(isset($_SESSION['admin'])){
        $admin_email=$_SESSION['admin']['mail'];
        $admin_password=$_SESSION['admin']['pass'];
        $error='<font color="FF0000">メールアドレスが既に登録されています。</font>';
    }
      echo '<div id="logtitle">';
      echo '<h2>新規管理者登録</h2>';
      echo '</div>';
    
      if(!isset($admin_email)){
          echo '<p><div id="mannaka">', $error, '</p></div>';
      }
    
      echo '<input type="email" style="width: 240px;height: 27px;" name="admin_email" placeholder="メールアドレス" required>';
      echo '</div>';
      echo '<br>';
      echo '<div id="pas2">';
      echo '<input type="password" style="width: 240px;height: 27px;" name="admin_password" placeholder="パスワード" pattern="^([a-zA-Z0-9]{6,})$" title="半角英数字6文字以上で入力ください" value="',$admin_password,'" required>';
      echo '</div>';
    ?>
    <br>
    <br>
        <p><button type="submit" class="ao">確認</button></p>
    </form>
</body>
</html>

