<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
 $_SESSION['members'] = [
    'sei' => $_POST['sei'],
    'mei' => $_POST['mei'],
    'seikana' => $_POST['seikana'],
    'meikana' => $_POST['meikana'],
    'nickname' => $_POST['nickname'],
    'zipcode' => $_POST['zipcode'],
    'prefecture' => $_POST['prefecture'],
    'city' => $_POST['city'],
    'address' => $_POST['address'],
    'bill' => $_POST['bill'],
    'tel' => $_POST['tel'],
    'mail' => $_POST['mail'],
    'pass' => $_POST['pass']
];

$pdo=new PDO($connect,USER,PASS);
$sql=$pdo->prepare('select * from Members where email=?');
$sql->execute([$_POST['mail']]);
if(!empty($sql->fetchAll())){
    $_SESSION['members']['mail']='';
    header('Location: ./member_new.php');
    exit();
}
?>
<?php require 'header.php'; ?>
    <h3>&cosme</h3>
    <hr>
    <h2>登録確認</h2>

    <form action="member_finish.php" method="post" id="next">
        <?php
        echo '<p><input type="text" name="sei" value="',$_POST['sei'], '" placeholder="',$_POST['sei'],'" readonly>';
        echo '<input type="text" name="mei" value="',$_POST['mei'], '" placeholder="',$_POST['mei'],'" readonly></p>';
        echo '<p><input type="text" name="seikana" value="',$_POST['seikana'], '" placeholder="',$_POST['seikana'],'" readonly>';
        echo '<input type="text" name="meikana" value="',$_POST['meikana'], '" placeholder="',$_POST['meikana'],'" readonly></p>';
        echo '<p><input type="text" name="nickname" value="',$_POST['nickname'], '" placeholder="',$_POST['nickname'],'" readonly></p>';
        echo '<p><input type="text" name="zipcode" value="',$_POST['zipcode'], '" placeholder="',$_POST['zipcode'],'" readonly>';
        echo '<p><input type="text" name="prefecture" value="',$_POST['prefecture'], '" placeholder="',$_POST['prefecture'],'" readonly></p>';
        echo '<p><input type="text" name="city" value="',$_POST['city'], '" placeholder="',$_POST['city'],'" readonly></p>';
        echo '<p><input type="text" name="address" value="',$_POST['address'], '" placeholder="',$_POST['address'],'" readonly></p>';
        echo '<p><input type="text" name="bill" value="',$_POST['bill'], '" placeholder="',$_POST['bill'],'" readonly></p>';
        echo '<p><input type="text" name="tel" value="',$_POST['tel'], '" placeholder="',$_POST['tel'],'" readonly></p>';
        echo '<p><input type="text" name="mail" value="',$_POST['mail'], '" placeholder="',$_POST['mail'],'" readonly></p>';
        echo '<p><input type="text" name="pass" value="',$_POST['pass'], '" placeholder="',$_POST['pass'],'" readonly></p>';
        ?>
    </form>
    <button onclick="history.back()" class="grey">変更</button></p>
    <button type="submit" form="next" class="ao">新規登録</button></p>
</body>
</html>
<?php require 'footer.php'; ?>