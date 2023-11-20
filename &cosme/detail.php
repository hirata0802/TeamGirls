<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/detail.css">
<title>&cosme</title>
</head>
<body>
<?php require 'menu.php'; ?>
<br><br><br>
<button onclick="history.back()">＜戻る</button>

<?php
    $pdo = new PDO($connect, USER, PASS);
    $cosme1 = $pdo -> prepare('select * from Cosmetics where cosme_id=? and group_id=? and brand_id=? and category_id=?');
    $cosme1 -> execute([$_GET['cosme_id'], $_GET['group_id'], $_GET['brand_id'], $_GET['category_id']]);
    $count = 1;

    echo '<div class="out">';
    echo '<div class="in">';
    foreach($cosme1 as $row){ 
        if($count==1){
            echo '<h3>',$row['cosme_name'],'</h3>';
            echo '<p>販売価格:',$row['price'],'</p>';
            $cosmeEx = $row['cosme_detail'];
            $count++;
        }   
        echo '<label><input type=radio name="slide"><span></span><a href="#"></a><img src="',$row['image_path'],'" width="200"></label>';
        $colorName = $row['color_name'];
    }
    echo $colorName;
    echo '</div>';
    echo '</div>';

    echo '<table><tr>';
    echo '<td><a href="cart.php?cosmeId=',$cosmeId,'"><button>カートに入れる</button></a></td>';
    if($row['delete_flag']==0){
        echo '<td><a href="favorite.php?cosmeId=',$cosmeId,'&page=0">★</a></td>';
    }else{
        echo '<td><a href="favorite.php?cosmeId=',$cosmeId,'&page=0">☆</a></td>';
    }
    //echo '<td><a href="favorite.php?cosmeId=',$cosmeId,'">　　　★</a></td></tr>';
    echo '<p>商品詳細</p>';
    echo '<p>',$cosmeEx,'</p>';
    echo '<p><strong>レビュー</strong></p>';

    echo    '<form action="#" method="post">';
    echo    '<input type="radio" name="detail" value=1>☆';
    echo    '<input type="radio" name="detail" value=2>☆';
    echo    '<input type="radio" name="detail" value=3>☆';
    echo    '<input type="radio" name="detail" value=4>☆';
    echo    '<input type="radio" name="detail" value=5>☆';
    echo    '<input type="submit" value="決定">';
    echo    '</form>';

//レビュー表示
    $review = $pdo -> prepare('select * from Reviews as R join Mypages as M on R.cosme_id = M.cosme_id where cosme_name = ?');
    $review -> execute([$_POST['cosme_name']]);
    $count = 1;
    if($count<=2){
        foreach($review as $row){
            echo $row['member_nickname'],$row['level'];
            echo $row['review_text'];
            echo '<hr>';
            $count++;
        }
    }
    echo '<td><a href="cart.php?cosmeId=',$cosmeId,'"><button>レビューをすべて見る</button></a></td>'; 
    echo '<td><a href="review.php"><button>レビューを書く</button></a></td>'; 
?>
<?php require 'footer.php'; ?>

if($row['delete_flag']==0){
                echo '<td><a href="favorite.php?cosmeId=',$cosmeId,'">★</a></td>';
                $sql = $pdo -> prepare('insert into Favorites values(?, ?, current_date, 0)');
                $sql -> execute([$_SESSION['customer']['code'], $_GET['cosmeId']]);
            }else{
                
                echo '<td><a href="favorite.php?cosmeId=',$cosmeId,'">☆</a></td>';
            }