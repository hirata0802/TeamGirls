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
        <!--<link rel="stylesheet" href="css/detail.css">-->
        <title>&cosme</title>
    </head>
    <body>
<?php require 'db_connect.php'; ?>
<?php require 'menu.php'; ?>
<br><br>
<?php
echo '<button onclick="location.href=`',$_SERVER['HTTP_REFERER'],'`">＜戻る</button>';

$pdo = new PDO($connect, USER, PASS);
$cosme1 = $pdo -> prepare('select * from Cosmetics where cosme_id=?');
$cosme1 -> execute([$_GET['cosme_id']]);
$groupCount = $pdo -> prepare('select count(group_id) from Cosmetics where group_id=(select group_id from Cosmetics where cosme_id=?)');
$groupCount -> execute([$_GET['cosme_id']]);

foreach($cosme1 as $row){ 
        $detail = $row['cosme_detail'];
        $cosmeId = $row['cosme_id'];
        $cosmeName = $row['cosme_name'];
        echo '<h3 align="center">',$row['cosme_name'],'</h3>';
        echo '<div class="out">';
        echo '<div class="in">';
        //echo '<label><input type=radio name="slide" checked><span></span><a href="#">
        //</a></label>';
        foreach($groupCount as $a){
            if($a['count(group_id)']>1){
                echo '<button onclick="location.href=`detail_next.php?group=', $row['group_id'], '&cosmeId=', $row['cosme_id'], '&next=0`">＜</button>';
                echo '<img src="',$row['image_path'],'" width="200" alt="',$row['color_name'],'">';
                echo '<button onclick="location.href=`detail_next.php?group=', $row['group_id'], '&cosmeId=', $row['cosme_id'], '&next=1`">＞</button>';
            }else{
                echo '<img src="',$row['image_path'],'" width="200" alt="',$row['color_name'],'">';
            }

        }
            echo '</div>';
            echo '</div>';
            echo '<p>販売価格：￥',$row['price'],'</p>';
            echo '<p>カラー：',$row['color_name'],'</p>';
    }

        //echo '<table><tr>';
        echo '<button onclick="location.href=`cart_input.php?cosmeId=',$cosmeId,'&page=0`">カートに入れる</button>';
    //echo '<p><a href="cart_input.php?cosmeId=',$cosmeId,'&page=0"><button>カートに入れる</button></a></p>';
        
        //お気に入り
    $cosme2 = $pdo -> prepare('select * from Favorites where member_code = ? and cosme_id=?');
    $cosme2 -> execute([$_SESSION['customer']['code'],$cosmeId]);//cosmeId=選んだコスメ
    $count = $cosme2 -> rowCount();
      
    if($count > 0){
        foreach($cosme2 as $row){
            if($row['delete_flag']==0){//1  //9
                echo '<button onclick="location.href=`favorite.phpcosmeId=',$cosmeId,'& page=0`">★</button>';
            }else{
                echo '<button onclick="location.href=`favorite.phpcosmeId=',$cosmeId,'& page=0`">☆</button>';
            }
        }
    }else{
        //echo '<form action="favorite.php" method="get">';
        echo '<button onclick="location.href=`favorite.phpcosmeId=',$cosmeId,'& page=2`">☆</button>';
        //echo '<a href="favorite.php?cosmeId=',$cosmeId,'&page=2">☆</a>';
    }

    echo '<p>商品詳細</p>';
    echo $detail;
?>
<?php
    if(isset($_SESSION['customer'])){
        $pdo=new PDO($connect, USER, PASS);
        $sql=$pdo->prepare('select * from Reviews R inner join Mypage M on R.member_code=M.member_code where R.member_code=? and R.cosme_id=?');
        $sql->execute([$_SESSION['customer']['code'], $cosmeId]);
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
                echo '<img src="', $row['image_path'], '" alt="">';   
            }
            echo '</div>';            
        }
    }
?>
<?php require 'footer.php'; ?>