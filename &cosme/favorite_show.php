<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php //require 'menu.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/detail.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
<title>&cosme</title>
</head>
<body>

<?php
    if(isset($_SESSION['customer'])){
        
        $pdo = new PDO($connect, USER, PASS);
        $memberCode = $_SESSION['customer']['code'];

        $sql2 ='select * from Favorites where delete_flag=0 and member_code = :memberCode';
        $sth = $pdo -> prepare($sql2);
        $sth -> bindValue(':memberCode', $memberCode);
        $sth -> execute();
        $count = $sth -> rowCount();
        echo '<p>',$count,'件  <button class="ao" onclick="location.href=\'serch_input.php\'">絞り込み</button></p>';
    
        //表示
        $sql = $pdo -> prepare('select * from Cosmetics as C inner join Favorites as F on C.cosme_id=F.cosme_id inner join Brands as B on C.brand_id=B.brand_id where F.member_code=?');
        //$sql = $pdo -> prepare('select * from Cosmetics as C inner join Favorites as F on C.cosme_id=F.cosme_id inner join Brands as B on C.brand_id=B.brand_id where F.member_code=? and delete_flag=0');
        $sql -> execute([$_SESSION['customer']['code']]);
        foreach($sql as $row){
            echo '<table>';
            $cosmeId = $row['cosme_id'];
            echo $cosmeId;
            echo '<tr>';
            echo '<td><img src="',$row['image_path'],' width=200"></td>';//商品詳細へ飛ばすのか？
            echo '</tr>';

            echo '<tr>';
            echo '<td>',$row['brand_name'],'</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td>',$row['cosme_name'],'</td>';
            //お気に入りボタン設定
            if($row['delete_flag']==0){
                echo '<td><a href="favorite.php?cosmeId=',$cosmeId,'">★</a></td>';
            }else{
                echo '<td><a href="favorite.php?cosmeId=',$cosmeId,'">☆</a></td>';
            }
            echo '</tr>';

            echo '<tr>';
            echo '<td>',$row['price'],'</td>';
            echo '<td><a href="cart.php?cosmeId=',$cosmeId,'">カートに入れる</a></td>';
            echo '</tr>';
            echo '</table>';
        }
        
    }
    ?>
    <script src="./js/favorite.js"></script>

<?php require 'footer.php'; ?>
