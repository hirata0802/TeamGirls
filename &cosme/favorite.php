<?php require 'db_connect.php'; ?>

<?php
    if(isset($_SESSION['member'])){
        echo '<table>';
        $pdo = new PDO($connect, USER, PASS);
        $sql = $pdo -> prepare('select * from Favorites, Cosmetics, Brands where member_code=? and cosme_id=cosme_id and brand_id=brand_id');
        $sql -> execute([$_SESSION['member']['id']]);

        foreach($sql as $row){
            $id = $row['id'];
            echo '<tr>';
            echo '<td>',$row['image_path'],'</td>';
            echo '<td>',$row['brand_name'],'</td>';
            echo '<td>',$row['cosme_name'],'</td>';
            echo '<td>',$row['price'],'</td>';
            echo '<td><a href="favorite-delete.php?id=',$id,'">削除</a></td>';
            echo '<td><a href="cart.php?id=',$id,'">カートに入れる</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    }
?>
