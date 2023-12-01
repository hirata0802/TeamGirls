<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/aaa.css">
<title>&cosme</title>
</head>
<body>
<nav>
    <ul>
        <li><h1>&cosme</h1></li>
        <li>
            <img src="css/image/home.svg" onclick="location.href='home.php'" width="40" height="40" alt="home">
            <div><font size="1">&nbsp;ホーム　　</font></div>
        </li>
        <li>
            <img src="css/image/search.svg" onclick="location.href='seach_input.php'" width="40" height="40" alt="search">
            <div><font size="1">　検索</font></div>
        </li>
        <li>  
            <img src="css/image/favorite_black.svg" onclick="location.href='favorite_show.php'" width="40" height="40" alt="favorite">
            <div><font size="1">お気に入り</font></div>
        </li>
        <li>
            <img src="css/image/cart.svg" onclick="location.href='cart_show.php'" width="40" height="40" alt="cart">
            <div><font size="1">&nbsp;カート</font></div>
        </li>
        <li>
            <img src="css/image/mypage.svg" onclick="location.href='mypage.php'" width="40" height="40" alt="mypage">
            <div><font size="1">マイページ</font></div>
        </li>
    </ul>
</nav>

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
            echo '<p align="center" style="font-size:15px;">現在お気に入り登録はありません</p>';
            echo '<table width="100%">';
        }else{
            //echo '<br>';
            echo '<p align="left" style="font-size:25px;">',$count,'件</p>';
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
                    echo '<tr><td colspan="3" align="center"><a href="detail.php?cosme_id=',$row['cosme_id'],'&group_id=',$row['group_id'],'&brand_id=',$row['brand_id'],'&category_id=',$row['category_id'],'"><img src="',$row['image_path'],'" style="object-fit: contain; width: 150px; height: 150px;"></a></td></tr>';
                    //コスメ名
                        echo '<tr><td colspan="3" align="left" white-space: nowrap>',$row['cosme_name'],'</td></tr>';
                    //ブランド名
                        echo '<tr><td colspan="3" align="left">',$row['brand_name'],'</td></tr>';
                    //価格
                        echo '<tr><td colspan="3">￥',$row['price'],'</td></tr>';
                    //カート、★
                        echo '<tr><td colspan="2" align="left"><a href="cart.php?cosmeId=',$cosmeId,'">カートに入れる</a></td>';
                        echo '<td align="right"><button onclick="location.href=`favorite.php?cosmeId=',$cosmeId,'& page=1`">★</button></td></tr>';
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
                            echo '<tr><td colspan="3" align="center"><a href="detail.php?cosme_id=',$row['cosme_id'],'&group_id=',$row['group_id'],'&brand_id=',$row['brand_id'],'&category_id=',$row['category_id'],'"><img src="',$row['image_path'],'" style="object-fit: contain; width: 100px; height: 100px;" ></a></td></tr>';
                            echo '<tr><td colspan="3" align="left"><font size="2px"><div class="b"><strong>',$row['cosme_name'],'</strong></div></font></td></tr>';
                            echo '<tr><td colspan="3" align="left"><font size="2px">',$row['brand_name'],'</font></td></tr>';
                            echo '<tr><td colspan="3"><font size="2px">￥',$row['price'],'</font></td></tr>';
                            echo '<tr><td colspan="2" align="left" white-space: nowrap><a href="cart.php?cosmeId=',$cosmeId,'">カートに入れる</a></td>';
                            echo '<td align="right"><button onclick="location.href=`favorite.php?cosmeId=',$cosmeId,'& page=1`">★</button></td>';
                            echo '</tr>';
                        echo '</table>';
                    echo '</td>';
                }else{
                    echo '<td>';
                        echo '<table width="60%">';
                            echo '<tr><td colspan="3" align="center"><a href="detail.php?cosme_id=',$row['cosme_id'],'&group_id=',$row['group_id'],'&brand_id=',$row['brand_id'],'&category_id=',$row['category_id'],'"><img src="',$row['image_path'],'" style="object-fit: contain; width: 100px; height: 100px;" ></a></td></tr>';
                            echo '<tr><td colspan="3" align="left"><font size="2px"><div class="b"><strong>',$row['cosme_name'],'</div></font></strong></td></tr>';
                            echo '<tr><td colspan="3" align="left"><font size="2px">',$row['brand_name'],'</font></td></tr>';
                            echo '<tr><td colspan="3"><font size="2px">￥',$row['price'],'</font></td></tr>';
                            echo '<tr><td colspan="2" align="left" white-space: nowrap><a href="cart.php?cosmeId=',$cosmeId,'">カートに入れる</a></td>';
                            echo '<td align="right"><button onclick="location.href=`favorite.php?cosmeId=',$cosmeId,'& page=1`">★</button></td>';
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
    
</body>
</html>