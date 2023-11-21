<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>&cosme</title>
</head>
<body>
    <?php require 'db_connect.php'; ?>
    <?php require 'menu.php'; ?>
    <button onclick="history.back()">＜戻る</button>
    <hr>
    <?php
    $pdo=new PDO($connect, USER, PASS);

    //複数選択
    if(isset($_POST['multiseach'])){
        if(!empty($_POST['max'])){
            if($_POST['categorySelect']==0 && $_POST['brandSelect']==0 && $_POST['colorSelect']==0){
                //料金あり　選択なし
                $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.price <= ?');
                $sql->execute([$_POST['max']]);
                $count=$sql->rowCount();
            }else if($_POST['categorySelect']!=0 && $_POST['brandSelect']!=0 && $_POST['colorSelect']!=0){
                //料金あり　全選択
                $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.category_id = ? and C.brand_id = ? and C.color_id = ? and C.price <= ?');
                $sql->execute([$_POST['categorySelect'],$_POST['brandSelect'],$_POST['colorSelect'],$_POST['max']]);
                $count=$sql->rowCount();
            }else if($_POST['categorySelect']!=0 && $_POST['brandSelect']!=0 && $_POST['colorSelect']==0){
                //料金あり　カテゴリー、ブランド選択
                $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.category_id = ? and C.brand_id = ? and C.price <= ?');
                $sql->execute([$_POST['categorySelect'],$_POST['brandSelect'],$_POST['max']]);
                $count=$sql->rowCount();
            }else if($_POST['categorySelect']!=0 && $_POST['brandSelect']==0 && $_POST['colorSelect']==0){
                //料金あり　カテゴリー選択
                $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.category_id = ? and C.price <= ?');
                $sql->execute([$_POST['categorySelect'],$_POST['max']]);
                $count=$sql->rowCount();
            }else if($_POST['categorySelect']==0 && $_POST['brandSelect']!=0 && $_POST['colorSelect']==0){
                //料金あり　ブランド選択
                $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.brand_id = ? and C.price <= ?');
                $sql->execute([$_POST['brandSelect'],$_POST['max']]);
                $count=$sql->rowCount();
            }else if($_POST['categorySelect']==0 && $_POST['brandSelect']!=0 && $_POST['colorSelect']!=0){
                //料金あり　ブランド、カラー選択
                $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.brand_id = ? and C.color_id = ? and C.price <= ?');
                $sql->execute([$_POST['brandSelect'],$_POST['colorSelect'],$_POST['max']]);
                $count=$sql->rowCount();
            }else if($_POST['categorySelect']==0 && $_POST['brandSelect']==0 && $_POST['colorSelect']!=0){
                //料金あり　カラー選択
                $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.color_id = ? and C.price <= ?');
                $sql->execute([$_POST['colorSelect'],$_POST['max']]);
                $count=$sql->rowCount();
            }else if($_POST['categorySelect']!=0 && $_POST['brandSelect']==0 && $_POST['colorSelect']!=0){
                //料金あり　カテゴリー、カラー選択
                $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.category_id = ? and C.color_id = ? and C.price <= ?');
                $sql->execute([$_POST['categorySelect'],$_POST['colorSelect'],$_POST['max']]);
                $count=$sql->rowCount();
            }
        }else{
            if($_POST['categorySelect']==0 && $_POST['brandSelect']==0 && $_POST['colorSelect']==0){
                //選択なし
                $sql=$pdo->query('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id');
                $count=$sql->rowCount();
            }else if($_POST['categorySelect']!=0 && $_POST['brandSelect']!=0 && $_POST['colorSelect']!=0){
                //全選択
                $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.category_id = ? and C.brand_id = ? and C.color_id = ?');
                $sql->execute([$_POST['categorySelect'],$_POST['brandSelect'],$_POST['colorSelect']]);
                $count=$sql->rowCount();
            }else if($_POST['categorySelect']!=0 && $_POST['brandSelect']!=0 && $_POST['colorSelect']==0){
                //カテゴリー、ブランド選択
                $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.category_id = ? and C.brand_id = ?');
                $sql->execute([$_POST['categorySelect'],$_POST['brandSelect']]);
                $count=$sql->rowCount();
            }else if($_POST['categorySelect']!=0 && $_POST['brandSelect']==0 && $_POST['colorSelect']==0){
                //カテゴリー選択
                $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.category_id = ?');
                $sql->execute([$_POST['categorySelect']]);
                $count=$sql->rowCount();
            }else if($_POST['categorySelect']==0 && $_POST['brandSelect']!=0 && $_POST['colorSelect']==0){
                //ブランド選択
                $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.brand_id = ?');
                $sql->execute([$_POST['brandSelect']]);
                $count=$sql->rowCount();
            }else if($_POST['categorySelect']==0 && $_POST['brandSelect']!=0 && $_POST['colorSelect']!=0){
                //ブランド、カラー選択
                $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.brand_id = ? and C.color_id = ?');
                $sql->execute([$_POST['brandSelect'],$_POST['colorSelect']]);
                $count=$sql->rowCount();
            }else if($_POST['categorySelect']==0 && $_POST['brandSelect']==0 && $_POST['colorSelect']!=0){
                //カラー選択
                $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.color_id = ?');
                $sql->execute([$_POST['colorSelect']]);
                $count=$sql->rowCount();
            }else if($_POST['categorySelect']!=0 && $_POST['brandSelect']==0 && $_POST['colorSelect']!=0){
                //カテゴリー、カラー選択
                $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.category_id = ? and C.color_id = ?');
                $sql->execute([$_POST['categorySelect'],$_POST['colorSelect']]);
                $count=$sql->rowCount();
            }
        }
    }
    if(!empty($_GET['kubun'])){
    if($_GET['kubun']==1){
        //カテゴリー
        $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.category_id = ?');
        $sql->execute([$_GET['id']]);
        $count=$sql->rowCount();
    }else if($_GET['kubun']==2){
        //ブランド
        $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.brand_id = ?');
        $sql->execute([$_GET['id']]);
        $count=$sql->rowCount();
    }else if($_GET['kubun']==3){
        $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.cosme_name like ?');
        $sql->execute(['%'.$_POST['keyword'].'%']);
        $count=$sql->rowCount();
    }else{
        $sql=$pdo->query('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id');
        $count=$sql->rowCount();
    }
}
    echo '<table width="100%">';
        echo '<th align="left" style="font-size:30px;">',$count,'件</th>';
        echo '<form action="detail.php" method="post">';
            $rowcount=1;
            echo '<tr>';
            if($count==1){
                //1件だけの場合
                foreach($sql as $row){
                    echo '<td align="center">';
                        echo '<table width="80%">';
                            echo '<tr><td colspan="3"align="center"><input type="image" src="',$row['image_path'],'" alt="',$row['cosme_name'],'" width="150px" height="150px" formaction="detail.php?cosme_id=',$row['cosme_id'],'&group_id=',$row['group_id'],'&brand_id=',$row['brand_id'],'&category_id=',$row['category_id'],'"></td></tr>';
                            echo '<tr><td colspan="3" align="left" white-space: nowrap>',$row['cosme_name'],'</td></tr>';
                            echo '<tr><td colspan="3" align="left">',$row['brand_name'],'</td></tr>';
                            echo '<tr><td colspan="3">',$row['price'],'</td></tr>';
                            echo '<tr><td colspan="2" align="left"><a href="cart.php?cosmeId=',$row['cosme_id'],'">カートに入れる</a></td><td align="right"><a href="favorite.php?cosmeId=',$row['cosme_id'],'&page=0">☆</a></td></tr>';
                        echo '</table>';
                    echo '</td><td></td>';
                    echo '</tr>';
                }
            }else{
                foreach($sql as $row){
                    if($rowcount%2!=0){
                        //テーブルの左側
                        echo '<td align="center">';
                            echo '<table width="80%">';
                                echo '<tr><td colspan="3"align="center"><input type="image" src="',$row['image_path'],'" alt="',$row['cosme_name'],'" width="150px" height="150px" formaction="detail.php?cosme_id=',$row['cosme_id'],'&group_id=',$row['group_id'],'&brand_id=',$row['brand_id'],'&category_id=',$row['category_id'],'"></td></tr>';
                                echo '<tr><td colspan="3" align="left" white-space: nowrap>',$row['cosme_name'],'</td><tr>';
                                echo '<tr><td colspan="3" align="left">',$row['brand_name'],'</td></tr>';
                                echo '<tr><td colspan="3">',$row['price'],'</td></tr>';
                                echo '<tr><td colspan="2" align="left"><a href="cart.php?cosmeId=',$row['cosme_id'],'">カートに入れる</a></td><td align="right"><a href="favorite.php?cosmeId=',$row['cosme_id'],'$page=0">☆</a></td></tr>';
                            echo '</table>';
                        echo '</td>';
                    }else{
                        //テーブルの右側
                        echo '<td align="center">';
                            echo '<table width="80%">';
                                echo '<tr><td colspan="3"align="center"><input type="image" src="',$row['image_path'],'" alt="',$row['cosme_name'],'" width="150px" height="150px" formaction="detail.php?cosme_id=',$row['cosme_id'],'&group_id=',$row['group_id'],'&brand_id=',$row['brand_id'],'&category_id=',$row['category_id'],'"></td></tr>';
                                echo '<tr><td colspan="3" align="left" white-space: nowrap>',$row['cosme_name'],'</td></tr>';
                                echo '<tr><td colspan="3" align="left">',$row['brand_name'],'</td></tr>';
                                echo '<tr><td colspan="3">',$row['price'],'</td></tr>';
                                echo '<tr><td colspan="2" align="left"><a href="cart.php?cosmeId=',$row['cosme_id'],'">カートに入れる</a></td><td align="right"><a href="favorite.php?cosmeId=',$row['cosme_id'],'&page=0">☆</a></td></tr>';
                            echo '</table>';
                        echo '</td>';
                        echo '</tr><tr>';
                    }
                    $rowcount++;
                }
            }
        echo '</table>';
    echo '</form>';
    
    ?>
<?php require 'footer.php'; ?>
