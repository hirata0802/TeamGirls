<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'db_connect.php'; ?>
<?php
$pdo=new PDO($connect,USER,PASS);
if(!isset($_SESSION['customer'])){
    $sql=$pdo->prepare('insert into Members values(null,?,?,?,?,?,?,?,?,?,?,?,?)');
    $sql->execute([
        $_POST['sei'],
        $_POST['mei'],
        $_POST['seikana'],
        $_POST['meikana'],
        $_POST['zipcode'],
        $_POST['prefecture'],
        $_POST['city'],
        $_POST['address'],
        $_POST['bill'],
        $_POST['tel'],
        $_POST['mail'],
        password_hash($_POST['pass'],PASSWORD_DEFAULT)]);
                
    $id=$pdo->lastInsertId();
    $adsName=$_POST['sei'].$_POST['mei'];
    $sql2=$pdo->prepare('insert into Addresses values(null,?,?,?,?,?,?,?,?,CURRENT_DATE)');
    $sql2->execute([
        $id,
        $adsName,
        $_POST['zipcode'],
        $_POST['prefecture'],
        $_POST['city'],
        $_POST['address'],
        $_POST['bill'],
        $_POST['tel']]);

    $nickname='unknown';
    if(!empty($_POST['nickname'])){
        $nickname=$_POST['nickname'];
    }
    $sql3=$pdo->prepare('insert into Mypage (member_code,member_nickname) values(?,?)');
    $sql3->execute([$id,$nickname]);

    $sql4=$pdo->prepare('select * from Members where member_code=?');
    $sql4->execute([$id]);
    foreach($sql4 as $row){
        $_SESSION['customer'] = [
            'code' => $row['member_code'],
            'familyName' => $row['family_name'],
            'firstName' => $row['first_name'],
            'familyKana' => $row['family_name_kana'],
            'firstKana' => $row['first_name_kana'],
            'post' => $row['post_code'],
            'prefecture'=>$row['prefecture'],
            'city'=>$row['city'],
            'section'=>$row['section'],
            'building'=>$row['building'],
            'phone' => $row['phone'],
            'mail' => $row['email'],
            'pass' => $row['member_password']];
    }
    echo '<h3>&cosme</h3>';
    echo '<div id="hr2">';
    echo '<hr color="black">';
    echo '</div>';
    echo '<div id="logtitle">';
    echo '<h2>登録完了</h2>';
    echo '</div>';
    echo '<div id="kaninkanryo">';
    echo '<p><font color="FF0000">',$_POST['sei'],$_POST['mei'],'様</font></p>';
    echo '<p><font color="FF0000">会員登録ありがとうございます。</font></p>';
    echo '</div>';
    echo '<form action="home.php" method="post">';
    echo '<button class="ao">ホームへ</button>';
    echo '</form><hr width="250">';
    echo '<div id="mannaka">';
    echo '<p>登録情報を確認・変更できます</p>';
    echo '<a href="mypage.php">＞マイページへ</a>';
    echo '</div>';
}
?>
<?php require 'footer.php'; ?>
 
