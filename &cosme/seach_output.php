<?php session_start(); 
    if(empty($_SESSION['customer'])){
        header('Location: ./error.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/fav.css">
    <title>&cosme</title>
</head>
<body>
<?php require 'db_connect.php'; ?>
<?php require 'menu_search.php'; ?>
<button onclick="location.href='seach_input.php'">＜戻る</button>
<?php
    $pdo=new PDO($connect, USER, PASS);
    $count;
    //検索内容をセッションに追加
    if(isset($_GET['page']) && $_GET['page']==10){
        unset($_SESSION['search']);
        if(isset($_POST['max']) || isset($_POST['categorySelect']) || isset($_POST['colorSelect']) || isset($_POST['brandSelect']) || isset($_POST['keyword'])){
            $_SESSION['search'] = [
                'max' => $_POST['max'],
                'categorySelect' => $_POST['categorySelect'],
                'colorSelect' => $_POST['colorSelect'],
                'brandSelect' => $_POST['brandSelect'],
                'keyword' => $_POST['keyword'],
            ];
        }
        if(isset($_GET['brand'])){
            $_SESSION['search']['brand'] = $_GET['brand'];
        }else if(isset($_GET['category'])){
            $_SESSION['search']['category'] = $_GET['category'];
        }
    }
    
    echo '<form action="detail.php" method="post">';
    $sql='select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where 1=1';
    $contains=[];
    //値段
    if(!empty($_SESSION['search']['max'])){
        $sql.=' and C.price <= ?';
        $contains[]=$_SESSION['search']['max'];
    }
    //カテゴリ
    if(!empty($_SESSION['search']['categorySelect'])){
        $sql.=' and C.category_id = ?';
        $contains[]=$_SESSION['search']['categorySelect'];
    }
    //カラー
    if(!empty($_SESSION['search']['colorSelect'])){
        $sql.=' and C.color_id = ?';
        $contains[]=$_SESSION['search']['colorSelect'];
    }
    //ブランド
    if(!empty($_SESSION['search']['brandSelect'])){
        $sql.=' and C.brand_id = ?';
        $contains[]=$_SESSION['search']['brandSelect'];
    }
    //キーワード
    if(!empty($_SESSION['search']['keyword'])){
        $sql.=' and C.cosme_name like ?';
        $contains[]='%'.$_SESSION['search']['keyword'].'%';
    }
    //カテゴリ
    if(!empty($_SESSION['search']['category'])){
        $sql.=' and C.category_id = ?';
        $contains[]=$_SESSION['search']['category'];
    }
    //ブランド
    if(!empty($_SESSION['search']['brand'])){
        $sql.=' and C.brand_id = ?';
        $contains[]=$_SESSION['search']['brand'];
    }
    $sql.=' order by C.group_id';
    $result=$pdo->prepare($sql);
    $result->execute($contains);
    $count=$result->rowCount();
    $message='';

    //カート、お気に入りの処理後表示
    if(isset($_GET['page'])){
        if($_GET['page']==20){
            $message = 'カートに追加しました';
        }
        else if($_GET['page']==31){
            $message = 'お気に入りから削除しました';
        }
        else if($_GET['page']==32){
            $message = 'お気に入りに追加しました';
        }
    }
    //画面表示
    echo '<div id="mannaka">';
    echo '<p style="color: red;">';
    echo $message;
    echo '</p>';
    echo '<p align="left" style="font-size:30px;">',$count,'件</p>';
    echo '</div>';
    echo '<table width="100%">';
    $rowcount=1;
    echo '<tr>';
    if($count==0){
        echo '<div id="mannaka">';
        echo 'お探しの商品はありません。';
        echo '</div>';
    }
    else if($count==1){
        //1件だけの場合
        foreach($result as $row){
            echo '<td align="center">';
            echo '<table width="80%">';
            //画像パス
            echo '<tr><td colspan="3"align="center"><input type="image" src="',$row['image_path'],'" alt="',$row['cosme_name'],'" style="object-fit: contain; width: 100px; height: 100px;" formaction="detail.php?cosme_id=',$row['cosme_id'],'&page=',count($_GET),'&search=0"></td></tr>';
            //コスメ名
            echo '<tr><td colspan="3" align="left" white-space: nowrap>',$row['cosme_name'],'</td></tr>';
            //ブランド名
            echo '<tr><td colspan="3" align="left">',$row['brand_name'],'</td></tr>';
            //カラー名
            echo '<tr><td colspan="3" align="left">',$row['color_name'],'</td></tr>';
            //値段
            echo '<tr><td colspan="3">￥',$row['price'],'</td></tr>';
            echo '<tr><td colspan="2" align="left"><a href="cart_input.php?cosmeId=',$row['cosme_id'],'&page=11">カートに入れる</a></td>';
            
            $member = $pdo -> prepare('select * from Favorites where cosme_id=? and member_code=?');
            $member -> execute([$row['cosme_id'], $_SESSION['customer']['code']]);
            if($member->rowCount() == 0){
                echo '<td align="right"><a href="favorite.php?cosmeId=',$row['cosme_id'],'&page=11"><img src="css/image/favorite.svg" style="width: 30px; height: 30px;"></a></td></tr>';
            }else{
                foreach($member as $a){
                    if($a['delete_flag']==0){
                        echo '<td align="right"><a href="favorite.php?cosmeId=',$row['cosme_id'],'&page=11"><img src="css/image/favorite_black.svg" style="width: 30px; height: 30px;"></a></td></tr>';
                    }else{
                        echo '<td align="right"><a href="favorite.php?cosmeId=',$row['cosme_id'],'&page=11"><img src="css/image/favorite.svg" style="width: 30px; height: 30px;"></a></td></tr>';
                    }
                    break;
                }
            }
            echo '</table>';
            echo '</td><td></td>';
            echo '</tr>';
        }
    }else{
        foreach($result as $row){
            if($rowcount%2!=0){
                //テーブルの左側
                echo '<td align="left">';
                echo '<table width="60%">';
                //画像パス
                echo '<tr><td colspan="3"align="center"><input type="image" src="',$row['image_path'],'" alt="',$row['cosme_name'],'" style="object-fit: contain; width: 100px; height: 100px;" formaction="detail.php?cosme_id=',$row['cosme_id'],'&page=',count($_GET),'&search=0"></td></tr>';
                //コスメ名
                echo '<tr><td colspan="3" align="left" white-space: nowrap><font size="2px"><strong><div class="b">',$row['cosme_name'],'</div></font></strong></td></tr>';
                //ブランド名
                echo '<tr><td colspan="3" align="left"><font size="2px">',$row['brand_name'],'</font></td></tr>';
                //カラー名
                echo '<tr><td colspan="3" align="left"><font size="2px">',$row['color_name'],'</font></td></tr>';
                //値段
                echo '<tr><td colspan="3">￥',$row['price'],'</td></tr>';
                echo '<tr><td colspan="2" align="left" white-space: nowrap><a href="cart_input.php?cosmeId=',$row['cosme_id'],'&page=11">カートに入れる</a></td>';
                
                //お気に入り
                $member = $pdo -> prepare('select * from Favorites where cosme_id=? and member_code=?');
                $member -> execute([$row['cosme_id'], $_SESSION['customer']['code']]);
                if($member->rowCount() == 0){
                    echo '<td align="right"><a href="favorite.php?cosmeId=',$row['cosme_id'],'&page=11"><img src="css/image/favorite.svg" style="width: 30px; height: 30px;"></a></td></tr>';
                }else{
                    foreach($member as $a){
                        if($a['delete_flag']==0){
                            echo '<td align="right"><a href="favorite.php?cosmeId=',$row['cosme_id'],'&page=11"><img src="css/image/favorite_black.svg" style="width: 30px; height: 30px;"></a></td></tr>';                               
                        }else{
                            echo '<td align="right"><a href="favorite.php?cosmeId=',$row['cosme_id'],'&page=11"><img src="css/image/favorite.svg" style="width: 30px; height: 30px;"></a></td></tr>';
                        }
                        break;
                    }
                }
                echo '</table>';
                echo '</td>';
            }else{
                //テーブルの右 
                echo '<td align="left">'; 
                echo '<table width="60%">';
                //画像パス
                echo '<tr><td colspan="3"align="center"><input type="image" src="',$row['image_path'],'" alt="',$row['cosme_name'],'" style="object-fit: contain; width: 100px; height: 100px;" formaction="detail.php?cosme_id=',$row['cosme_id'],'&page=',count($_GET),'&search=0"></td></tr>';
                //コスメ名
                echo '<tr><td colspan="3" align="left" white-space: nowrap><font size="2px"><strong><div class="b">',$row['cosme_name'],'</div></font></strong></td></tr>';
                //ブランド名
                echo '<tr><td colspan="3" align="left"><font size="2px">',$row['brand_name'],'</font></td></tr>';
                //カラー名
                echo '<tr><td colspan="3" align="left"><font size="2px">',$row['color_name'],'</font></td></tr>';
                //値段
                echo '<tr><td colspan="3">￥',$row['price'],'</td></tr>';
                echo '<tr><td colspan="2" align="left" white-space: nowrap><a href="cart_input.php?cosmeId=',$row['cosme_id'],'&page=11">カートに入れる</a></td>';
                
                $member = $pdo -> prepare('select * from Favorites where cosme_id=? and member_code=?');
                $member -> execute([$row['cosme_id'], $_SESSION['customer']['code']]);
                if($member->rowCount() == 0){
                    echo '<td align="right"><a href="favorite.php?cosmeId=',$row['cosme_id'],'&page=11"><img src="css/image/favorite.svg" style="width: 30px; height: 30px;"></a></td></tr>';
                }else{
                    foreach($member as $a){
                        if($a['delete_flag']==0){
                            echo '<td align="right"><a href="favorite.php?cosmeId=',$row['cosme_id'],'&page=11"><img src="css/image/favorite_black.svg" style="width: 30px; height: 30px;"></a></td></tr>';
                        }else{
                            echo '<td align="right"><a href="favorite.php?cosmeId=',$row['cosme_id'],'&page=11"><img src="css/image/favorite.svg" style="width: 30px; height: 30px;"></a></td></tr>';
                        }
                        break;
                    }
                }
                echo '</table>';
                echo '</td>';
                echo '</tr><tr>';
            }
            $rowcount++;
        }
    }
    echo '</table>';
    echo '</div>';
    echo '</form>';
?>
<?php require 'footer.php'; ?>
