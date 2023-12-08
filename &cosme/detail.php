<?php session_start(); 
    if(isset($_GET['search'])){
        unset($_SESSION['detail']);
        $_SESSION['detail']=end($_SESSION['history']);
        if($_GET['page']==0){
            $_SESSION['detail'].='?detail=0';
        }else{
            $_SESSION['detail'].='&detail=0';
        }
    }else if(isset($_GET['favorite'])){
        unset($_SESSION['detail']);
        $_SESSION['detail']='./favorite_show.php';
    }else if(isset($_GET['review'])){
        unset($_SESSION['detail']);
        $_SESSION['detail']='./history.php';
    }else if(isset($_GET['home'])){
        unset($_SESSION['detail']);
        $_SESSION['detail']='./home.php';
    }
    //ページのURLをセッションに保存
    if(!isset($_SESSION['history'])){
        $_SESSION['history'] = array();
    }
    array_push($_SESSION['history'], $_SERVER['REQUEST_URI']);
?>
<?php 
if(empty($_SESSION['customer'])){
    header('Location: ./error.php');
    exit();
}
?>
<?php require 'header.php'; ?>
<?php require 'db_connect.php'; ?>
<?php require 'menu.php'; ?>
<?php
    //カート、お気に入りの処理後表示
    if(isset($_GET['page'])){
        echo '<p style="color: red;">';
        if($_GET['page']==20){
            echo 'カートに追加しました';
        }
        else if($_GET['page']==31){
            echo 'お気に入りから削除しました';
        }
        else if($_GET['page']==32){
            echo 'お気に入りに追加しました';
        }
        echo '</p>';
    }
    echo '<button onclick="location.href=`',$_SESSION['detail'],'`">＜戻る</button>';
    $pdo = new PDO($connect, USER, PASS);
    $cosme1 = $pdo -> prepare('select * from Cosmetics where cosme_id=?');
    $cosme1 -> execute([$_GET['cosme_id']]);
    $groupCount = $pdo -> prepare('select count(group_id) from Cosmetics where group_id=(select group_id from Cosmetics where cosme_id=?)');
    $groupCount -> execute([$_GET['cosme_id']]);
    //商品詳細表示
    foreach($cosme1 as $row){ 
        $detail = $row['cosme_detail'];
        $cosmeId = $row['cosme_id'];
        $cosmeName = $row['cosme_name'];
        echo '<h3 align="center">',$row['cosme_name'],'</h3>';
        echo '<div style="text-align: center">';
        foreach($groupCount as $a){
            if($a['count(group_id)']>1){
                echo '<button onclick="location.href=`detail_next.php?group=', $row['group_id'], '&cosmeId=', $row['cosme_id'], '&next=0`">＜</button>';
                echo '<img src="',$row['image_path'],'" style="object-fit: contain; width: 200px; height: 200px;", alt="',$row['color_name'],'">';
                echo '<button onclick="location.href=`detail_next.php?group=', $row['group_id'], '&cosmeId=', $row['cosme_id'], '&next=1`">＞</button>';
            }else{
                echo '<img src="',$row['image_path'],'" style="object-fit: contain; width: 200px; height: 200px;", alt="',$row['color_name'],'">';
            }
            
        }
        echo '</div>';
        echo '<br>';
        echo '<p>販売価格：￥',$row['price'],'</p>';
        if(!empty($row['color_name'])){
            echo '<p>カラー　：',$row['color_name'],'</p>';
        }
    }
    echo '<div id="mannaka">';
    //カート
    echo '<button class="ao"  onclick="location.href=`cart_input.php?cosmeId=',$cosmeId,'&page=',count($_GET),'`"><img src="css/image/cart_black.svg" style="width: 20px; height: 20px;" alt="カートに入れる">カートに入れる</button>';
    //お気に入り
    $cosme2 = $pdo -> prepare('select * from Favorites where member_code = ? and cosme_id=?');
    $cosme2 -> execute([$_SESSION['customer']['code'],$cosmeId]);//cosmeId=選んだコスメ
    $count = $cosme2 -> rowCount();
    if($count > 0){
        foreach($cosme2 as $row){
            if($row['delete_flag']==0){
                echo '<button onclick="location.href=`favorite.php?cosmeId=',$cosmeId,'&page=',count($_GET),'`">★</button>';
            }else{
                echo '<button onclick="location.href=`favorite.php?cosmeId=',$cosmeId,'&page=',count($_GET),'`">☆</button>';
            }
        }
    }else{
        echo '<button onclick="location.href=`favorite.php?cosmeId=',$cosmeId,'&page=',count($_GET),'`">☆</button>';
    }
    echo '</div>';
    echo '<div style="text-align: center">';
    echo '<strong><p align="center">商品詳細</p></strong>';
    echo '</div>';
    echo '<div class="c">';
    echo $detail;
    echo '</div><br>';
    
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('select * from Reviews R inner join Mypage M on R.member_code=M.member_code where R.cosme_id=?');
    $sql->execute([$cosmeId]);
    $count = $sql -> rowCount();
    
    echo '<strong><p align="center">レビュー</p></strong>';
    echo '<hr>';
    if($count==0){
        echo '<p align="center">現在レビューはありません</p>';
    }else{
        foreach($sql as $row){
            echo '<div style="padding: 10px; margin-bottom: 10px; border: 1px solid #333333; border-radius: 10px;">';
            echo '<p>', $cosmeName, '　';
            for($i=0; $i<5; $i++){
                if($i<$row['level']){
                    echo '★';
                }
                else{
                    echo '☆';
                }
            }
            echo '</p>';
            echo '<p>', $row['member_nickname'], '　';
            echo $row['member_age'], '/';
            echo $row['member_skin'], '/';
            echo $row['member_color'], '</p>';
            echo '<p>', $row['review_text'], '</p>';
            if(!empty($row['image_path'])){
                echo '<div style="text-align: center">';
                echo '<img src="', $row['image_path'], '" alt="" width="320px">';
                echo '</div>';   
            }
            echo '</div>';            
        }
    }
?>
<?php require 'footer.php'; ?>