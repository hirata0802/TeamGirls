<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php require 'header.php'; ?>
<?php //require 'menu.php'; ?>

<button onclick="history.back()">＜戻る</button>

<?php
    $color = ['レッド', 'オレンジ', 'ピンク', 'ベージュ', '白', 'ブラウン', 'ブラック', 'シルバー', 'ゴールド', 'その他'];

    $pdo = new PDO($connect, USER, PASS);

     echo '<h3>',$_POST['cosme_name'],'</h3>';
// //商品詳細表示
     echo '<div class="out">';
     echo    '<div class="in">';
     $cosme = $pdo -> prepare('select * from Cosmetics where group_id=? and brand_id=? and category_id=?');
     $cosme -> execute([$_POST['group_id'], $_POST['brand_id'], $_POST['category_id']]);
     $cosmeCount = $cosme -> rowCount();

     //foreach($cosme as $row){ //カラー取得
       //  if($cosmeCount == 0){
             //'<label><input type=radio name="slide" checked><span></span><a href="#"><img src="',$_row['image_path'],'" width="200"></a></label>';
         //}
         //$cosmeCount--;
     //}
    echo '<p>販売価格:',$cosme['price'],'</p>';
    echo '<p>カラー:',$color['color_id'],'</p>';
    echo '</div>';
    echo '</div>';

    echo '<table><tr>';
    echo '<td><a href="cart.php?cosmeId=',$cosmeId,'"><button>カートに入れる</button></a></td>'; 
    echo '<td><a href="favorite.php?cosmeId=',$cosmeId,'">　　　★</a></td></tr>';
    echo '<p>商品詳細</p>';
    echo '<p>',$cosme['cosme_ex'],'</p>';
    echo '<p><strong>レビュー</strong></p>';

//レビュー評価★
    echo '<form action="#" method="post">';
    echo    '<input type="radio" name="detail" value="1">☆';
    echo    '<input type="radio" name="detail" value="2">☆';
    echo    '<input type="radio" name="detail" value="3">☆';
    echo    '<input type="radio" name="detail" value="4">☆';
    echo    '<input type="radio" name="detail" value="5">☆';
    echo    '<div class="ao"><button type="submit">送信</button></div>';
    echo '</form>';

//レビュー表示
    $review = $pdo -> prepare('select * from Reviews as R join Mypages as M on R.cosme_id = M.cosme_id where cosme_name = ?');
    $review -> execute([$_POST['cosme_name']]);
    $count = 1;
    if($count<=2){
        foreach($review as $row){
            echo $_POST['member_nickname'],$_POST['level'];
            echo $_POST['review_text'];
            echo '<hr>';
            $count++;
        }
    }
    echo '<td><a href="cart.php?cosmeId=',$cosmeId,'"><button>レビューをすべて見る</button></a></td>'; 
    echo '<td><a href="review.php"><button>レビューを書く</button></a></td>'; 
?>
<?php require 'footer.php'; ?>