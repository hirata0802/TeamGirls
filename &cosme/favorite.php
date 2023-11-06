<?php require 'db_connect.php'?>
<?php require 'header.php'; ?>

<?php
if(isset($_SESSION['customer'])){
    echo '<table>';
    $pdo = new PDO($connect, USER, PASS);
    $sql = $pdo -> prepare('select * from Favorites, Cosmetics where member_code=? and cosme_id=cosme_id');
    $sql -> execute([$_SESSION['customer']['id']]);
    foreach($sql as $row){
        $id = $row['id'];
        echo '<tr>';
        echo '<td>',$row['brand_id'],'</td>';
        echo '<td>',$row['name'],'</td>';
        echo '<td>',$row['price'],'</td>';
        echo '<td><a href="favorite-delete.php?id=',$id,'">削除</a></td>';
        echo '<td><a href="cart.php?id=',$id,'">カートに入れる</a></td>';
        echo '</tr>';
    }
    echo '</table>';
}
?>
<?php require 'footer.php'; ?>