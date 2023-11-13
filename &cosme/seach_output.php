<?php require 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>seach-output</title>
</head>
<body>
    <?php require 'menu.php'; ?>
    <button onclick="history.back()">＜戻る</button>
    <hr>
    <?php
    $pdo=new PDO($connect, USER, PASS);
    if($_GET['kubun']==1){
        //カテゴリー
        $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.category_id = ?');
        $sql->execute([$_GET['id']]);
        $count=$sql->rowCount();
        echo 'a';
    }else if($_GET['kubun']==2){
        //ブランド
        $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.brand_id = ?');
        $sql->execute([$_GET['id']]);
        $count=$sql->rowCount();
        echo 'b';
    }else if($_GET['kubun']==3){
        $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.cosme_name like ?');
        $sql->execute(['%'.$_POST['keyword'].'%']);
        $count=$sql->rowCount();
    }else{
        $sql=$pdo->query('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id');
        $count=$sql->rowCount();
    }
    echo '<table>';
        echo '<th colspan="2">',$count,'件</th><th align="right"><button type="button">絞り込み</button></th>';
        echo '<form action="detail.php" method="post">';
            $rowcount=1;
            echo '<tr>';
            foreach($sql as $row){
                if($rowcount%2!=0){
                    echo '<td>';
                        echo '<table>';
                            echo '<tr><td colspan="3"align="center"><input type="image" src="',$row['image_path'],'" alt="',$row['cosme_name'],'" width="150px" height="150px"></td></tr>';
                            echo '<tr><td colspan="3" align="left">',$row['brand_name'],'</td></tr>';
                            echo '<tr><td colspan="2" align="left">',$row['cosme_name'],'</td><td><a href="#">☆</a></td><tr>';
                            echo '<tr><td>',$row['price'],'</td><td colspan=2 align="right"><a href="#">カートに入れる</a></td></tr>';
                        echo '</table>';
                    echo '</td>';
                }else{
                    echo '<td>';
                        echo '<table>';
                            echo '<tr><td colspan="3"align="center"><input type="image" src="',$row['image_path'],'" alt="',$row['cosme_name'],'" width="150px" height="150px"></td></tr>';
                            echo '<tr><td colspan="3" align="left">',$row['brand_name'],'</td></tr>';
                            echo '<tr><td colspan="2" align="left">',$row['cosme_name'],'</td><td><a href="#">☆</a></td></tr>';
                            echo '<tr><td>',$row['price'],'</td><td colspan=2 align="right"><a href="#">カートに入れる</a></td></tr>';
                        echo '</table>';
                    echo '</td>';
                    echo '</tr><tr>';
                }
                $rowcount++;
            }
        echo '</table>';
    echo '</form>';
    
    ?>
</body>
</html>
