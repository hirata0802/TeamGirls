<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php //require 'menu.php'; ?>
<?php require 'header.php'; ?>

<?php
    if(isset($_SESSION['customer'])){
        
        $pdo = new PDO($connect, USER, PASS);
        $memberCode = $_SESSION['customer']['code'];

        $sql2 ='select * from Favorites where member_code = :memberCode';
        $sth = $pdo -> prepare($sql2);
        $sth -> bindValue(':memberCode', $memberCode);
        $sth -> execute();
        $count = $sth -> rowCount();
        echo '<p>',$count,'件  <button class="ao" onclick="location.href=\'serch_input.php\'">絞り込み</button></p>';
    
        $sql = $pdo -> prepare('select * from Cosmetics as C inner join Favorites as F on C.cosme_id=F.cosme_id inner join Brands as B on C.brand_id=B.brand_id where F.member_code=?');
        $sql -> execute([$_SESSION['customer']['code']]);
        
        foreach($sql as $row){
            echo '<table>';
            $cosmeId = $row['cosme_id'];
            echo $cosmeId;
            echo '<tr>';
            echo '<td><img src="',$row['image_path'],'"></td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td>',$row['brand_name'],'</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td>',$row['cosme_name'],'</td>';
            echo '<td><a href="favorite.php?cosmeId=',$cosmeId,'">　　　★</a></td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td>',$row['price'],'</td>';
            echo '<td><a href="cart.php?cosmeId=',$cosmeId,'">カートに入れる</a></td>';
            echo '</tr>';
            echo '</table>';
        }
        
    }
?>
<?php require 'footer.php'; ?>
