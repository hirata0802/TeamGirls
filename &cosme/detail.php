<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>

<button onclick="history.back()">＜戻る</button>

<?php
    echo '<h3>',$_POST['cosme_name'],'</h3>';

//商品詳細表示
    echo '<div class="out">';
    echo    '<div class="in">';
    $counts = 1;
        foreach($counts==1){ //カラー取得
            '<label><input type=radio name="slide" checked><span></span><a href="#"><img src="',$_POST['image_path'],'" width="200"></a></label>';
        }

        echo '<p>販売価格:',$_POST['price'],'</p>';
        echo '<p>カラー:',$_POST['color_id'],'</p>';
    echo '</div>';
    echo '</div>';

    echo '<table><tr>';
    echo '<td><a href="cart.php?cosmeId=',$cosmeId,'"><button>カートに入れる</button></a></td>'; 
    echo '<td><a href="favorite.php?cosmeId=',$cosmeId,'">　　　★</a></td></tr>';
    echo '<p>商品詳細</p>';
    echo '<p>',$_POST['cosme_ex'],'</p>';
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
    $pdo = new PDO($connect, USER, PASS);
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