<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
    $pdo = new PDO($connect,USER,PASS);
    $delete_flag = $pdo -> prepare('select delete_flag from Favorites where member_code = ? and cosme_id = ?');
    $delete_flag -> execute([$_SESSION['customer']['code'], $_GET['cosmeId']]);

foreach($delete_flag as $row){
    if($_GET['page'] == 1){//お気に入り画面からの遷移
        if($row["delete_flag"] == 0){//お気に入り削除
            $sql = $pdo -> prepare('update Favorites set delete_flag=1,register_date=current_date where member_code = ? and cosme_id = ?');
            $sql -> execute([$_SESSION['customer']['code'], $_GET['cosmeId']]);
        }
        header('Location: ./favorite_show.php');
        exit();
    }else if($_GET['page'] == 0){//商品詳細画面からの遷移
        if($row["delete_flag"] == 0){//お気に入り削除
            $sql = $pdo -> prepare('update Favorites set delete_flag=1,register_date=current_date where member_code = ? and cosme_id = ?');
            $sql -> execute([$_SESSION['customer']['code'], $_GET['cosmeId']]);
            header('Location: ./favorite_show.php');
            exit();
        }else{//お気に入り追加
            $sql = $pdo -> prepare('insert into Favorites values(?, ?, current_date, 0)');
            $sql -> execute([$_GET['cosmeId'], $_SESSION['customer']['code']]); 
            if($_GET['page'] == 0){
                header('Location: ./detail.php');
                exit();
            }
        }
        header('Location: ./detail.php');
        exit();
    }
}
?>



  <?php/**以前のお気に入り表示
        $sql = $pdo -> prepare('select * from Cosmetics as C inner join Favorites as F on C.cosme_id=F.cosme_id inner join Brands as B on C.brand_id=B.brand_id where F.member_code=? and delete_flag=0');
        $sql -> execute([$_SESSION['customer']['code']]);
        echo '<p>',$count,'件</p>';
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
                echo '<td><a href="favorite.php?cosmeId=',$cosmeId,'">☆</a></td>';
                $sql = $pdo -> prepare('insert into Favorites values(?, ?, current_date, 0)');
                $sql -> execute([$_SESSION['customer']['code'], $_GET['cosmeId']]);
            echo '</tr>';

            echo '<tr>';
            echo '<td>',$row['price'],'</td>';
            echo '<td><a href="cart.php?cosmeId=',$cosmeId,'">カートに入れる</a></td>';
            echo '</tr>';
            echo '</table>';
        }
        **/
    ?>