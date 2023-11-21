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
        echo '<br><br>';
        echo '<table width="100%">';
        echo '<th align="left">',$count,'件</th>';
        $sql = $pdo -> prepare('select * from Cosmetics as C inner join Favorites as F on C.cosme_id=F.cosme_id inner join Brands as B on C.brand_id=B.brand_id where F.member_code=? and delete_flag=0');
        $sql -> execute([$_SESSION['customer']['code']]);
        $rowcount = 1;
        foreach($sql as $row){
            $cosmeId = $row['cosme_id'];
            if($rowcount%2!=0){
                echo '<td>';
                    echo '<table width="80%">';
                        echo '<tr>';
                        echo '<td colspan="3" align="center"><img src="',$row['image_path'],' width=150px" height="150px"></td>';//商品詳細へ飛ばすのか？
                        echo '</tr>';

                        echo '<tr>';
                        echo '<td colspan="3" align="left" white-space: nowrap>',$row['cosme_name'],'</td>';
                        echo '</tr>';

                        echo '<tr>';
                        echo '<td colspan="3" align="left">',$row['brand_name'],'</td>';
                        echo '</tr>';

                        echo '<tr>';
                        echo '<td colspan="3">',$row['price'],'</td>';
                        echo '</tr>';

                        echo '<tr>';
                        echo '<td colspan="2" align="left"><a href="cart.php?cosmeId=',$cosmeId,'">カートに入れる</a></td>';
                        echo '<td align="right"><a href="favorite.php?cosmeId=',$cosmeId,'&page=1">☆</a></td>';
                        echo '</tr>';
                    echo '</table>';
                echo '</td>';
            }else{
                echo '<td>';
                    echo '<table width="80%">';
                        echo '<tr>';
                        echo '<td colspan="3" align="center"><img src="',$row['image_path'],' width=150px" height="150px"></td>';//商品詳細へ飛ばすのか？
                        echo '</tr>';

                        echo '<tr>';
                        echo '<td colspan="3" align="left" white-space: nowrap>',$row['cosme_name'],'</td>';
                        echo '</tr>';

                        echo '<tr>';
                        echo '<td colspan="3" align="left">',$row['brand_name'],'</td>';
                        echo '</tr>';

                        echo '<tr>';
                        echo '<td colspan="3">',$row['price'],'</td>';
                        echo '</tr>';

                        echo '<tr>';
                        echo '<td colspan="2" align="left"><a href="cart.php?cosmeId=',$cosmeId,'">カートに入れる</a></td>';
                        echo '<td align="right"><a href="favorite.php?cosmeId=',$cosmeId,'&page=1">☆</a></td>';
                        echo '</tr>';
                    echo '</table>';
                echo '</td>';
            }
        $rowcount++;
        }
    }
    echo '</table>';
    ?>

<?php require 'footer.php'; ?>
