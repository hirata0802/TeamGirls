<?php session_start(); ?>
<?php require 'db_connect.php'; ?>

<?php
$errmsg="";
$statusMsg="";
if($_GET['page'] == 0){
    if(!empty($_POST['rate']) && isset($_POST['honbun'])){
        if(!empty($_FILES['file']['name'])){
            $targetDir="image/uploads/";
            $fileName=basename($_FILES['file']['name']);
            $targetFilePath=$targetDir.$fileName;
            $fileType=pathinfo($targetFilePath,PATHINFO_EXTENSION);
            $allowTypes = array('jpg','png','jpeg');
            if(in_array($fileType,$allowTypes)){
                if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFilePath)){
                    echo 'e!';
                    //dekina---i
                }
                echo 'u-n';
            }else{
                echo 'ok';
            }
            
            echo '変な';
        }
            /*
            $sql=$pdo->prepare('insert into Reviews values(?, ?, ?, ?, ?)');
            $sql->
            */
    }else{
        $errmsg='入力されていない項目があります';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <title>&cosme</title>
    </head>
    <body>
    <?php require 'menu.php'; ?>
    <button onclick="location.href='history.php'">＜戻る</button>
    <h3>商品レビューを書く</h3>
    <?php
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('select cosme_name from Cosmetics where cosme_id = ?');
    $sql->execute([$_GET['Rnew']]);
    $cosme_name=$sql->fetchColumn();
    $cosme_id=$_GET['Rnew'];
    echo '<p>',$cosme_name,'</p>';
    echo '<p>満足度';
    echo '<form action="review_new.php?Rnew=',$cosme_id,'&page=0" method="post" enctype="multipart/form-data">';
        echo '<div class="rate-form">';
            echo '<input id="star5" type="radio" name="rate" value="5">';
            echo '<label for="star5">★</label>';
            echo '<input id="star4" type="radio" name="rate" value="4">';
            echo '<label for="star4">★</label>';
            echo '<input id="star3" type="radio" name="rate" value="3">';
            echo '<label for="star3">★</label>';
            echo '<input id="star2" type="radio" name="rate" value="2">';
            echo '<label for="star2">★</label>';
            echo '<input id="star1" type="radio" name="rate" value="1">';
            echo '<label for="star1">★</label>';
        echo '</div>';
        echo '</p>';
        echo '<p>レビュー本文';
        echo '<textarea name="honbun" cols="30" rows="10"></textarea></p>';
        echo '<p>画像の追加（任意）';
            echo '<input type="file" name="file">';
        echo '</p>';
        echo '<font color="FF0000">',$errmsg,'</font>';
        echo '<button type="submit" class="ao">投稿する</button></div>';
    echo '</form>';
?>
</body>
</html>