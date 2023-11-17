<?php require 'header.php'; ?>
<?php require 'db_connect.php'; ?>
<?php require 'menu.php'; ?>
    <button onclick="history.back()">＜戻る</button>
    <hr>
    <?php
    $pdo=new PDO($connect, USER, PASS);

    //複数選択
    if(isset($_POST['multiseach'])){
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
        echo '<th align="left">',$count,'件</th>';
        echo '<form action="detail.php" method="post">';
            $rowcount=1;
            echo '<tr>';
            foreach($sql as $row){
                if($rowcount%2!=0){
                    echo '<td>';
                        echo '<table width="80%">';
                            echo '<tr><td colspan="3"align="center"><input type="image" src="',$row['image_path'],'" alt="',$row['cosme_name'],'" width="150px" height="150px"></td></tr>';
                            echo '<tr><td colspan="2" align="left" white-space: nowrap>',$row['cosme_name'],'</td><td align="right"><a href="#">☆</a></td><tr>';
                            echo '<tr><td colspan="3" align="left">',$row['brand_name'],'</td></tr>';
                            echo '<tr><td width="30%">',$row['price'],'</td><td colspan="2" align="right"><a href="#">カートに入れる</a></td></tr>';
                        echo '</table>';
                    echo '</td>';
                }else{
                    echo '<td>';
                        echo '<table width="80%">';
                            echo '<tr><td colspan="3"align="center"><input type="image" src="',$row['image_path'],'" alt="',$row['cosme_name'],'" width="150px" height="150px"></td></tr>';
                            echo '<tr><td colspan="2" align="left" white-space: nowrap>',$row['cosme_name'],'</td><td align="right"><a href="#">☆</a></td></tr>';
                            echo '<tr><td colspan="3" align="left">',$row['brand_name'],'</td></tr>';
                            echo '<tr><td width="30%">',$row['price'],'</td><td colspan="2" align="right"><a href="#">カートに入れる</a></td></tr>';
                        echo '</table>';
                    echo '</td>';
                    echo '</tr><tr>';
                }
                $rowcount++;
            }
        echo '</table>';
    echo '</form>';
    
    ?>
<?php require 'footer.php'; ?>
