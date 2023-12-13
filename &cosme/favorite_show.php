<?php session_start();
    if(empty($_SESSION['customer'])){
        header('Location: ./error.php');
        exit();
    }
    /*ページのURLをセッションに保存
    if(!isset($_SESSION['history'])){
        $_SESSION['history'] = array();
    }
    array_push($_SESSION['history'], $_SERVER['REQUEST_URI']);*/
?>
<?php require 'db_connect.php'; ?>
<?php require 'header.php'; ?>
<?php require 'menu_favorite.php'; ?>
<?php
        $pdo = new PDO($connect, USER, PASS);
        $memberCode = $_SESSION['customer']['code'];
        $sql2 = $pdo -> prepare('select * from Favorites where delete_flag=0 and member_code=?');
        $sql2 -> execute([$_SESSION['customer']['code']]);
        $count = $sql2 -> rowCount();
        
        //表示
        if(isset($_GET['page'])){
            echo '<div id="mannaka">';
            echo '<p style="color: red;">';
            if($_GET['page']==20){
                echo 'カートに追加しました。';
            }
            else if($_GET['page']==31){
                echo 'お気に入りから削除しました。';
            }
            else if($_GET['page']==32){
                echo 'お気に入りに追加しました。';
            }
            echo '</p>';
            echo '</div>';   
        }   
        if($count==0){
            echo '<p align="center" style="font-size:20px;">現在お気に入り登録はありません。</p>';
            echo '<table width="100%">';
        }else{
            echo '<p align="left" style="font-size:30px;">',$count,'件</p>';
            echo '<table width="100%">';
        }
        $sql = $pdo -> prepare('select * from Cosmetics as C inner join Favorites as F on C.cosme_id=F.cosme_id inner join Brands as B on C.brand_id=B.brand_id where F.member_code=? and delete_flag=0 order by F.register_date desc');
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
                echo '<tr><td colspan="3" align="center"><a href="detail.php?cosme_id=',$row['cosme_id'],'&page=30&favorite=0"><img src="',$row['image_path'],'" style="object-fit: contain; width: 150px; height: 150px;"></a></td></tr>';
                //コスメ名
                echo '<tr><td colspan="3" align="left" white-space: nowrap>',$row['cosme_name'],'</td></tr>';
                //ブランド名
                echo '<tr><td colspan="3" align="left">',$row['brand_name'],'</td></tr>';
                //カラー名
                echo '<tr><td colspan="3" align="left">',$row['color_name'],'</td></tr>';
                //価格
                echo '<tr><td colspan="3">￥',$row['price'],'</td></tr>';
                //カート、★
                echo '<tr><td colspan="2" align="left"><a href="cart_input.php?cosmeId=',$cosmeId,'&page=30">カートに入れる</a></td>';
                echo '<td align="right"><button onclick="location.href=`favorite.php?cosmeId=',$cosmeId,'&page=30`"><img src="css/image/favorite_black.svg" style="width: 30px; height: 30px;"></button></td></tr>';
                echo '</table>';
                echo '</td><td></td>';
                echo '</tr>';
            }
        }else{
            foreach($sql as $row){
                $cosmeId = $row['cosme_id'];
                if($rowcount%2!=0){
                    echo '<td>';
                    echo '<table width="60%">';
                    //画像パス
                    echo '<tr><td colspan="3" align="center"><a href="detail.php?cosme_id=',$row['cosme_id'],'&page=30&favorite=0"><img src="',$row['image_path'],'" style="object-fit: contain; width: 100px; height: 100px;" ></a></td></tr>';
                    //コスメ名
                    echo '<tr><td colspan="3" align="left"><font size="2px"><div class="b"><strong>',$row['cosme_name'],'</strong></div></font></td></tr>';
                    //ブランド名
                    echo '<tr><td colspan="3" align="left"><font size="2px">',$row['brand_name'],'</font></td></tr>';
                    //カラー名
                    echo '<tr><td colspan="3" align="left"><font size="2px">',$row['color_name'],'</font></td></tr>';
                    //値段
                    echo '<tr><td colspan="3"><font size="2px">￥',$row['price'],'</font></td></tr>';
                    echo '<tr><td colspan="2" align="left" white-space: nowrap><a href="cart_input.php?cosmeId=',$cosmeId,'&page=30">カートに入れる</a></td>';
                    echo '<td align="right"><button onclick="location.href=`favorite.php?cosmeId=',$cosmeId,'&page=30`"><img src="css/image/favorite_black.svg" style="width: 30px; height: 30px;"></button></td>';
                    echo '</tr>';
                    echo '</table>';
                    echo '</td>';
                }else{
                    echo '<td>';
                    echo '<table width="60%">';
                    //画像パス
                    echo '<tr><td colspan="3" align="center"><a href="detail.php?cosme_id=',$row['cosme_id'],'&page=30&favorite=0"><img src="',$row['image_path'],'" style="object-fit: contain; width: 100px; height: 100px;" ></a></td></tr>';
                    //コスメ名
                    echo '<tr><td colspan="3" align="left"><font size="2px"><div class="b"><strong>',$row['cosme_name'],'</div></font></strong></td></tr>';
                    //ブランド名
                    echo '<tr><td colspan="3" align="left"><font size="2px">',$row['brand_name'],'</font></td></tr>';
                    //カラー名
                    echo '<tr><td colspan="3" align="left">',$row['color_name'],'</td></tr>';
                    //値段
                    echo '<tr><td colspan="3"><font size="2px">￥',$row['price'],'</font></td></tr>';
                    echo '<tr><td colspan="2" align="left" white-space: nowrap><a href="cart_input.php?cosmeId=',$cosmeId,'&page=30">カートに入れる</a></td>';
                    echo '<td align="right"><button onclick="location.href=`favorite.php?cosmeId=',$cosmeId,'&page=30`"><img src="css/image/favorite_black.svg" style="width: 30px; height: 30px;"></button></td>';                   
                    echo '</tr>';
                    echo '</table>';
                    echo '</td>';
                    echo '</tr><tr>';
                }
                $rowcount++;
            }
        }
        echo '</table>';  
?>
<?php require 'footer.php'; ?>