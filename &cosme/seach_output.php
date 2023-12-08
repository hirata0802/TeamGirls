<?php session_start(); 
    //ページのURLをセッションに保存
    if(!isset($_SESSION['history'])){
        $_SESSION['history'] = array();
    }
    array_push($_SESSION['history'], $_SERVER['REQUEST_URI']);
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
<hr>
<?php
    $pdo=new PDO($connect, USER, PASS);
    $count;
    //検索内容をセッションに追加
    if(isset($_GET['page']) && $_GET['page']==10){
        unset($_SESSION['search']);
        if(isset($_POST['multiseach'])){
            $_SESSION['search'] = [
                'multiseach' => $_POST['multiseach'],
                'max' => $_POST['max'],
                'categorySelect' => $_POST['categorySelect'],
                'colorSelect' => $_POST['colorSelect'],
                'brandSelect' => $_POST['brandSelect'],
                'keyword' => $_POST['keyword']
            ];
        }else{
            $_SESSION['search'] = [
                'max' => $_POST['max'],
                'categorySelect' => $_POST['categorySelect'],
                'colorSelect' => $_POST['colorSelect'],
                'brandSelect' => $_POST['brandSelect'],
                'keyword' => $_POST['keyword']
            ];
        }
    }
    
    //複数選択
    echo '<form action="seach_output.php" method="post">';
    if(isset($_SESSION['search']['multiseach'])){
        if(!empty($_POST['max'])){
            if($_SESSION['search']['categorySelect']==0 && $_SESSION['search']['brandSelect']==0 && $_SESSION['search']['colorSelect']==0){
                //料金あり　選択なし
                $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.price <= ?');
                $sql->execute([$_SESSION['search']['max']]);
                $count=$sql->rowCount();
            }else if($_SESSION['search']['categorySelect']!=0 && $_SESSION['search']['brandSelect']!=0 && $_SESSION['search']['colorSelect']!=0){
                //料金あり　全選択
                $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.category_id = ? and C.brand_id = ? and C.color_id = ? and C.price <= ?');
                $sql->execute([$_SESSION['search']['categorySelect'],$_SESSION['search']['brandSelect'],$_SESSION['search']['colorSelect'],$_SESSION['search']['max']]);
                $count=$sql->rowCount();
            }else if($_SESSION['search']['categorySelect']!=0 && $_SESSION['search']['brandSelect']!=0 && $_SESSION['search']['colorSelect']==0){
                //料金あり　カテゴリー、ブランド選択
                $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.category_id = ? and C.brand_id = ? and C.price <= ?');
                $sql->execute([$_SESSION['search']['categorySelect'],$_SESSION['search']['brandSelect'],$_SESSION['search']['max']]);
                $count=$sql->rowCount();
            }else if($_SESSION['search']['categorySelect']!=0 && $_SESSION['search']['brandSelect']==0 && $_SESSION['search']['colorSelect']==0){
                //料金あり　カテゴリー選択
                $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.category_id = ? and C.price <= ?');
                $sql->execute([$_SESSION['search']['categorySelect'],$_SESSION['search']['max']]);
                $count=$sql->rowCount();
            }else if($_SESSION['search']['categorySelect']==0 && $_SESSION['search']['brandSelect']!=0 && $_SESSION['search']['colorSelect']==0){
                //料金あり　ブランド選択
                $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.brand_id = ? and C.price <= ?');
                $sql->execute([$_SESSION['search']['brandSelect'],$_SESSION['search']['max']]);
                $count=$sql->rowCount();
            }else if($_SESSION['search']['categorySelect']==0 && $_SESSION['search']['brandSelect']!=0 && $_SESSION['search']['colorSelect']!=0){
                //料金あり　ブランド、カラー選択
                $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.brand_id = ? and C.color_id = ? and C.price <= ?');
                $sql->execute([$_SESSION['search']['brandSelect'],$_SESSION['search']['colorSelect'],$_SESSION['search']['max']]);
                $count=$sql->rowCount();
            }else if($_SESSION['search']['categorySelect']==0 && $_SESSION['search']['brandSelect']==0 && $_SESSION['search']['colorSelect']!=0){
                //料金あり　カラー選択
                $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.color_id = ? and C.price <= ?');
                $sql->execute([$_SESSION['search']['colorSelect'],$_SESSION['search']['max']]);
                $count=$sql->rowCount();
            }else if($_SESSION['search']['categorySelect']!=0 && $_SESSION['search']['brandSelect']==0 && $_SESSION['search']['colorSelect']!=0){
                //料金あり　カテゴリー、カラー選択
                $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.category_id = ? and C.color_id = ? and C.price <= ?');
                $sql->execute([$_SESSION['search']['categorySelect'],$_SESSION['search']['colorSelect'],$_SESSION['search']['max']]);
                $count=$sql->rowCount();
            }
        }else{
            if($_SESSION['search']['categorySelect']==0 && $_SESSION['search']['brandSelect']==0 && $_SESSION['search']['colorSelect']==0){
                //選択なし
                $sql=$pdo->query('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id');
                $count=$sql->rowCount();
            }else if($_SESSION['search']['categorySelect']!=0 && $_SESSION['search']['brandSelect']!=0 && $_SESSION['search']['colorSelect']!=0){
                //全選択
                $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.category_id = ? and C.brand_id = ? and C.color_id = ?');
                $sql->execute([$_SESSION['search']['categorySelect'],$_SESSION['search']['brandSelect'],$_SESSION['search']['colorSelect']]);
                $count=$sql->rowCount();
            }else if($_SESSION['search']['categorySelect']!=0 && $_SESSION['search']['brandSelect']!=0 && $_SESSION['search']['colorSelect']==0){
                //カテゴリー、ブランド選択
                $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.category_id = ? and C.brand_id = ?');
                $sql->execute([$_SESSION['search']['categorySelect'],$_SESSION['search']['brandSelect']]);
                $count=$sql->rowCount();
            }else if($_SESSION['search']['categorySelect']!=0 && $_SESSION['search']['brandSelect']==0 && $_SESSION['search']['colorSelect']==0){
                //カテゴリー選択
                $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.category_id = ?');
                $sql->execute([$_SESSION['search']['categorySelect']]);
                $count=$sql->rowCount();
            }else if($_SESSION['search']['categorySelect']==0 && $_SESSION['search']['brandSelect']!=0 && $_SESSION['search']['colorSelect']==0){
                //ブランド選択
                $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.brand_id = ?');
                $sql->execute([$_SESSION['search']['brandSelect']]);
                $count=$sql->rowCount();
            }else if($_SESSION['search']['categorySelect']==0 && $_SESSION['search']['brandSelect']!=0 && $_SESSION['search']['colorSelect']!=0){
                //ブランド、カラー選択
                $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.brand_id = ? and C.color_id = ?');
                $sql->execute([$_SESSION['search']['brandSelect'],$_SESSION['search']['colorSelect']]);
                $count=$sql->rowCount();
            }else if($_SESSION['search']['categorySelect']==0 && $_SESSION['search']['brandSelect']==0 && $_SESSION['search']['colorSelect']!=0){
                //カラー選択
                $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.color_id = ?');
                $sql->execute([$_SESSION['search']['colorSelect']]);
                $count=$sql->rowCount();
            }else if($_SESSION['search']['categorySelect']!=0 && $_SESSION['search']['brandSelect']==0 && $_SESSION['search']['colorSelect']!=0){
                //カテゴリー、カラー選択
                $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.category_id = ? and C.color_id = ?');
                $sql->execute([$_SESSION['search']['categorySelect'],$_SESSION['search']['colorSelect']]);
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
            //キーワード
            $sql=$pdo->prepare('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id where C.cosme_name like ?');
            $sql->execute(['%'.$_SESSION['search']['keyword'].'%']);
            $count=$sql->rowCount();
        }else{
            $sql=$pdo->query('select * from Cosmetics C inner join Brands B on C.brand_id = B.brand_id');
            $count=$sql->rowCount();
        }
    }
    if(isset($_GET['page'])){
        if($_GET['page']==20){
            echo 'カートに追加しました';
        }
        else if($_GET['page']==31){
            echo 'お気に入りから削除しました';
        }
        else if($_GET['page']==32){
            echo 'お気に入りに追加しました';
        }
    }
    echo '<table width="100%">';
        echo '<th align="left" style="font-size:30px;">',$count,'件</th>';
            $rowcount=1;
            echo '<tr>';
            if($count==1){
                //1件だけの場合
                foreach($sql as $row){
                    echo '<td align="center">';
                    echo '<table width="80%">';
                    echo '<tr><td colspan="3"align="center"><input type="image" src="',$row['image_path'],'" alt="',$row['cosme_name'],'" style="object-fit: contain; width: 100px; height: 100px;" formaction="detail.php?cosme_id=',$row['cosme_id'],'"></td></tr>';
                    echo '<tr><td colspan="3" align="left" white-space: nowrap>',$row['cosme_name'],'</td></tr>';
                    echo '<tr><td colspan="3" align="left">',$row['brand_name'],'</td></tr>';
                    echo '<tr><td colspan="3">￥',$row['price'],'</td></tr>';
                    echo '<tr><td colspan="2" align="left"><a href="cart_input.php?cosmeId=',$row['cosme_id'],'&page=',count($_GET),'">カートに入れる</a></td>';
                    
                    $member = $pdo -> prepare('select * from Favorites where cosme_id=? and member_code=?');
                    $member -> execute([$row['cosme_id'], $_SESSION['customer']['code']]);
                    if($member->rowCount() == 0){
                        echo '<td align="right"><a href="favorite.php?cosmeId=',$row['cosme_id'],'&page=',count($_GET),'">☆</a></td></tr>';
                    }else{
                        foreach($member as $a){
                            if($a['delete_flag']==0){
                                echo '<td align="right"><a href="favorite.php?cosmeId=',$row['cosme_id'],'&page=',count($_GET),'"><img src="css/image/favorite_black.svg" style="width: 30px; height: 30px;"></a></td></tr>';
                            }else{
                                echo '<td align="right"><a href="favorite.php?cosmeId=',$row['cosme_id'],'&page=',count($_GET),'"><img src="css/image/favorite.svg" style="width: 30px; height: 30px;"></a></td></tr>';
                            }
                            break;
                        }
                    }
                    echo '</table>';
                    echo '</td><td></td>';
                    echo '</tr>';
                }
            }else{
                foreach($sql as $row){
                    if($rowcount%2!=0){
                        //テーブルの左側
                        echo '<td align="left">';
                        echo '<table width="60%">';
                        echo '<tr><td colspan="3"align="center"><input type="image" src="',$row['image_path'],'" alt="',$row['cosme_name'],'" style="object-fit: contain; width: 100px; height: 100px;" formaction="detail.php?cosme_id=',$row['cosme_id'],'"></td></tr>';
                        echo '<tr><td colspan="3" align="left" white-space: nowrap><font size="2px"><strong><div class="b">',$row['cosme_name'],'</div></font></strong></td></tr>';
                        echo '<tr><td colspan="3" align="left"><font size="2px">',$row['brand_name'],'</font></td></tr>';
                        echo '<tr><td colspan="3">￥',$row['price'],'</td></tr>';
                        echo '<tr><td colspan="2" align="left" white-space: nowrap><a href="cart_input.php?cosmeId=',$row['cosme_id'],'&page=',count($_GET),'">カートに入れる</a></td>';
                        
                        //お気に入り
                        $member = $pdo -> prepare('select * from Favorites where cosme_id=? and member_code=?');
                        $member -> execute([$row['cosme_id'], $_SESSION['customer']['code']]);
                        if($member->rowCount() == 0){
                            echo '<td align="right"><a href="favorite.php?cosmeId=',$row['cosme_id'],'&page=',count($_GET),'"><img src="css/image/favorite.svg" style="width: 30px; height: 30px;"></a></td></tr>';
                        }else{
                            foreach($member as $a){
                                if($a['delete_flag']==0){
                                    echo '<td align="right"><a href="favorite.php?cosmeId=',$row['cosme_id'],'&page=',count($_GET),'"><img src="css/image/favorite_black.svg" style="width: 30px; height: 30px;"></a></td></tr>';                               
                                }else{
                                    echo '<td align="right"><a href="favorite.php?cosmeId=',$row['cosme_id'],'&page=',count($_GET),'"><img src="css/image/favorite.svg" style="width: 30px; height: 30px;"></a></td></tr>';
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
                        echo '<tr><td colspan="3"align="center"><input type="image" src="',$row['image_path'],'" alt="',$row['cosme_name'],'" style="object-fit: contain; width: 100px; height: 100px;" formaction="detail.php?cosme_id=',$row['cosme_id'],'"></td></tr>';
                        echo '<tr><td colspan="3" align="left" white-space: nowrap><font size="2px"><strong><div class="b">',$row['cosme_name'],'</div></font></strong></td></tr>';
                        echo '<tr><td colspan="3" align="left"><font size="2px">',$row['brand_name'],'</font></td></tr>';
                        echo '<tr><td colspan="3">￥',$row['price'],'</td></tr>';
                        echo '<tr><td colspan="2" align="left" white-space: nowrap><a href="cart_input.php?cosmeId=',$row['cosme_id'],'&page=',count($_GET),'">カートに入れる</a></td>';

                        $member = $pdo -> prepare('select * from Favorites where cosme_id=? and member_code=?');
                        $member -> execute([$row['cosme_id'], $_SESSION['customer']['code']]);
                        if($member->rowCount() == 0){
                            echo '<td align="right"><a href="favorite.php?cosmeId=',$row['cosme_id'],'&page=',count($_GET),'"><img src="css/image/favorite.svg" style="width: 30px; height: 30px;"></a></td></tr>';
                        }else{
                            foreach($member as $a){
                                if($a['delete_flag']==0){
                                    echo '<td align="right"><a href="favorite.php?cosmeId=',$row['cosme_id'],'&page=',count($_GET),'"><img src="css/image/favorite_black.svg" style="width: 30px; height: 30px;"></a></td></tr>';
                                }else{
                                    echo '<td align="right"><a href="favorite.php?cosmeId=',$row['cosme_id'],'&page=',count($_GET),'"><img src="css/image/favorite.svg" style="width: 30px; height: 30px;"></a></td></tr>';
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
