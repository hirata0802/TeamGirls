<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<?php
    $_SESSION['cosme']=[
        '$cosme_name'=> $_POST['cosme_name'],
        '$color_name'=> $_POST['color_name'],
        '$group_id'=> $_POST['group_id'],
        '$color_id'=> $_POST['color_id'],
        '$brand_id'=> $_POST['brand_id'],
        '$category_id'=> $_POST['category_id'],
        '$cosme_detail'=> $_POST['cosme_detail'],
        '$price'=> $_POST['price'],
        '$image_path'=> $_POST['image_path'],
        '$creation_date'=> $_POST['creation_date']
    ];
//仮
$pdo = new PDO($connect, USER, PASS);
$sql = $pdo -> prepare('select * from Cosmetics where ??');
$sql->execute([$_POST['mail']]);
if(!empty($sql->fetchAll())){
    $_SESSION['members']['mail']=null;
    header('Location: ./member_new.php');
    exit();
}
?>
<?php require 'header.php'; ?>
<h3>&cosme</h3>
<h2>コスメ登録確認</h2>

    <form action="k_cosme_finish.php" method="post" id="next">
        <?php
        echo '<div id="simei">';
        echo '<input type="text" style="width: 100px;height: 30px;" name="cosme_name" value="',$_POST['cosme_name'], '" placeholder="',$_POST['cosme_name'],'" readonly>';
        echo '<input type="text" style="width: 100px;height: 30px;" name="color_name" value="',$_POST['color_name'], '" placeholder="',$_POST['color_name'],'" readonly>';
        echo '</div>';
        echo '<div id="mannaka">';
        echo '<p><input type="text" style="width: 125px;height: 30px;" name="group_id" value="',$_POST['group_id'], '" placeholder="',$_POST['group_id'],'" readonly>';
        echo '<input type="text" style="width: 125px;height: 30px;" name="color_id" value="',$_POST['color_id'], '" placeholder="',$_POST['color_id'],'" readonly></p>';
        echo '<div id="toroku0">';
        echo '<p><input type="text" style="width: 260px;height: 30px;" name="brand_id" value="',$_POST['brand_id'], '" placeholder="',$_POST['brand_id'],'" readonly></p>';
        echo '</div>';
        echo '<div id="yuubin">';
        echo '<input type="text" style="width: 240px;height: 27px;" name="category_id" value="',$_POST['category_id'], '" placeholder="',$_POST['category_id'],'" readonly>';
        echo '</div>';
        echo '<div id="toroku1">';
        echo '<p><input type="text" name="cosme_detail" value="',$_POST['cosme_detail'], '" placeholder="',$_POST['cosme_detail'],'" readonly></p>';
        echo '<p><input type="text" name="price" value="',$_POST['price'], '" placeholder="',$_POST['price'],'" readonly></p>';
        echo '<p><input type="text" name="image_path" value="',$_POST['image_path'], '" placeholder="',$_POST['image_path'],'" readonly></p>';
        echo '<p><input type="text" name="creation_date" value="',$_POST['creation_date'], '" placeholder="',$_POST['creation_date'],'" readonly></p>';
        echo '</div>';
        ?>
    </form>
    <br>
    <button onclick="history.back()" class="grey">変更</button></p><br>
    <button type="submit" form="next" class="ao">コスメ新規登録</button></p>
</body>
</html>
<?php require 'footer.php'; ?>