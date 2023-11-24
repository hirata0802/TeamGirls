<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php require 'header.php'; ?>
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
    $_SESSION['members']['mail']=null;
    header('Location: ./member_new.php');
    exit();
}
?>
<h3>&cosme</h3>
<div id="hr2"><hr color="black"></div>
<div id="logtitle"><h2>登録確認</h2></div>

    <form action="member_finish.php" method="post" id="next">
        <?php
        echo '<div id="simei">';
        echo '<input type="text" style="width: 100px;height: 30px;" name="sei" value="',$_POST['sei'], '" placeholder="',$_POST['sei'],'" readonly>';
        echo '<input type="text" style="width: 100px;height: 30px;" name="mei" value="',$_POST['mei'], '" placeholder="',$_POST['mei'],'" readonly>';
        echo '</div>';
        echo '<div id="mannaka">';
        echo '<p><input type="text" style="width: 125px;height: 30px;" name="seikana" value="',$_POST['seikana'], '" placeholder="',$_POST['seikana'],'" readonly>';
        echo '<input type="text" style="width: 125px;height: 30px;" name="meikana" value="',$_POST['meikana'], '" placeholder="',$_POST['meikana'],'" readonly></p>';
        echo '<div id="toroku0">';
        echo '<p><input type="text" style="width: 260px;height: 30px;" name="nickname" value="',$_POST['nickname'], '" placeholder="',$_POST['nickname'],'" readonly></p>';
        echo '</div>';
        echo '<div id="yuubin">';
        echo '<input type="text" style="width: 240px;height: 27px;" name="zipcode" value="',$_POST['zipcode'], '" placeholder="',$_POST['zipcode'],'" readonly>';
        echo '</div>';
        echo '<div id="toroku1">';
        echo '<p><input type="text" name="prefecture" value="',$_POST['prefecture'], '" placeholder="',$_POST['prefecture'],'" readonly></p>';
        echo '<p><input type="text" name="city" value="',$_POST['city'], '" placeholder="',$_POST['city'],'" readonly></p>';
        echo '<p><input type="text" name="address" value="',$_POST['address'], '" placeholder="',$_POST['address'],'" readonly></p>';
        echo '<p><input type="text" name="bill" value="',$_POST['bill'], '" placeholder="',$_POST['bill'],'" readonly></p>';
        echo '</div>';
        echo '<div id="tell">';
        echo '<input type="text" style="width: 240px;height: 27px;" name="tel" value="',$_POST['tel'], '" placeholder="',$_POST['tel'],'" readonly>';
        echo '</div>';
        echo '<br>';
        echo '<div id="meru2">';
        echo '<input type="text" style="width: 240px;height: 27x;" name="mail" value="',$_POST['mail'], '" placeholder="',$_POST['mail'],'" readonly>';
        echo '</div>';
        echo '<br>';
        echo '<div id="pas2">';
        echo '<input type="text" style="width: 240px;height: 27x;" name="pass" value="',$_POST['pass'], '" placeholder="',$_POST['pass'],'" readonly>';
        echo '</div>';
        ?>
    </form>
    <br>
    <button onclick="history.back()" class="grey">変更</button></p><br>
    <button type="submit" form="next" class="ao">新規登録</button></p>
</body>
</html>
<?php require 'footer.php'; ?>