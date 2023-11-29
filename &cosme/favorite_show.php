<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>

<?php
    if(isset($_SESSION['customer'])){
        
        $pdo = new PDO($connect, USER, PASS);
        $memberCode = $_SESSION['customer']['code'];

        $sql2 = $pdo -> prepare('select * from Favorites where delete_flag=0 and member_code=?');
        $sql2 -> execute([$_SESSION['customer']['code']]);
        $count = $sql2 -> rowCount();
        
        //表示
        if($count==0){
            echo '<br>';
            echo '<p align="center" style="font-size:20px;">現在お気に入り登録はありません</p>';
            echo '<table width="100%">';
        }else{
            echo '<br>';
            echo '<p align="left" style="font-size:30px;">',$count,'件</p>';
            echo '<table width="100%">';
        }
        $sql = $pdo -> prepare('select * from Cosmetics as C inner join Favorites as F on C.cosme_id=F.cosme_id inner join Brands as B on C.brand_id=B.brand_id where F.member_code=? and delete_flag=0');
        $sql -> execute([$_SESSION['customer']['code']]);
        $rowcount = 1;
        
        echo '<tr>';
        if($count==1){
            foreach($sql as $row){
                $cosmeId = $row['cosme_id'];
                $a=$cosmeId.$row['group_id'].$row['brand_id'].$row['category_id'];
                echo '<td align="center">';
                    echo '<table width="80%">';
                    //画像パス
                    echo '<tr><td colspan="3" align="center"><a href="detail.php?cosme_id=',$row['cosme_id'],'&group_id=',$row['group_id'],'&brand_id=',$row['brand_id'],'&category_id=',$row['category_id'],'"><img src="',$row['image_path'],'" width=150px" height="150px"></a></td></tr>';
                    //コスメ名
                        echo '<tr><td colspan="3" align="left" white-space: nowrap>',$row['cosme_name'],',',$row['cosme_id'],'</td></tr>';
                    //ブランド名
                        echo '<tr><td colspan="3" align="left">',$row['brand_name'],'</td></tr>';
                    //価格
                        echo '<tr><td colspan="3">',$row['price'],'</td></tr>';
                    //カート、★
                        echo '<tr><td colspan="2" align="left"><a href="cart.php?cosmeId=',$cosmeId,'">カートに入れる</a></td>';
                        echo '<td align="right"><a href="favorite.php?cosmeId=',$cosmeId,'&page=1">★</a></td></tr>';
                        echo '</table>';
                        echo '</td><td></td>';
                        echo '</tr>';
            }
        }else{
            foreach($sql as $row){
                $cosmeId = $row['cosme_id'];
                if($rowcount%2!=0){
                    echo '<td align="center">';
                        echo '<table width="80%">';
                            echo '<tr><td colspan="3" align="center"><a href="detail.php?cosme_id=',$row['cosme_id'],'&group_id=',$row['group_id'],'&brand_id=',$row['brand_id'],'&category_id=',$row['category_id'],'"><img src="',$row['image_path'],'" width=150px" height="150px"></a></td></tr>';
                            echo '<tr><td colspan="3" align="left" white-space: nowrap>',$row['cosme_name'],',',$row['cosme_id'],'</td></tr>';
                            echo '<tr><td colspan="3" align="left">',$row['brand_name'],'</td></tr>';
                            echo '<tr><td colspan="3">',$row['price'],'</td></tr>';
                            echo '<tr><td colspan="2" align="left"><a href="cart.php?cosmeId=',$cosmeId,'">カートに入れる</a></td>';
                            echo '<td align="right"><a href="favorite.php?cosmeId=',$cosmeId,'&page=1">★</a></td>';
                            echo '</tr>';
                        echo '</table>';
                    echo '</td>';
                }else{
                    echo '<td align="center">';
                        echo '<table width="80%">';
                            echo '<tr><td colspan="3" align="center"><a href="detail.php?cosme_id=',$row['cosme_id'],'&group_id=',$row['group_id'],'&brand_id=',$row['brand_id'],'&category_id=',$row['category_id'],'"><img src="',$row['image_path'],'" width=150px" height="150px"></a></td></tr>';
                            echo '<tr><td colspan="3" align="left" white-space: nowrap>',$row['cosme_name'],',',$row['cosme_id'],'</td></tr>';
                            echo '<tr><td colspan="3" align="left">',$row['brand_name'],'</td></tr>';
                            echo '<tr><td colspan="3">',$row['price'],'</td></tr>';
                            echo '<tr><td colspan="2" align="left"><a href="cart.php?cosmeId=',$cosmeId,'">カートに入れる</a></td>';
                            echo '<td align="right"><a href="favorite.php?cosmeId=',$cosmeId,'&page=1">★</a></td>';
                            echo '</tr>';
                        echo '</table>';
                    echo '</td>';
                    echo '</tr><tr>';
                }
                $rowcount++;
            }
        }
        echo '</table>';  
    }
    ?>
<?php require 'footer.php'; ?>
