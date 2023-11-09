
<?php
    if(isset($_SESSION['customer'])){
        echo '<table>';
        $pdo = new PDO($connect, USER, PASS);
        $sql = $pdo -> prepare('select * from Favorites join Cosmetics on Favorites.cosme_id=Cosmetics.cosme_id join Brands on Favorites.brand_id=Brands.brand_id where Favorites.member_code=?');
        //Cosmetics, Brands where member_code=? and cosme_id=cosme_id and brand_id=brand_id
        $sql -> execute([$_SESSION['customer']['id']]);

        foreach($sql as $row){
            $id = $row['id'];
            echo '<tr>';
            echo '<td>',$row['image_path'],'</td>';
            echo '<td>',$row['brand_name'],'</td>';
            echo '<td>',$row['cosme_name'],'</td>';
            echo '<td>',$row['price'],'</td>';
            echo '<td><a href="favorite_delete.php?id=',$id,'">削除</a></td>';
            echo '<td><a href="cart.php?id=',$id,'">カートに入れる</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    }
?>
