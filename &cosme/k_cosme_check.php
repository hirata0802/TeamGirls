<?php
session_start();
if(empty($_SESSION['admin'])){
    header('Location: ./k_error.php');
    exit();
}
?>
<?php require 'db_connect.php'; ?>
<?php
    $_SESSION['newCosme'] = [   //セッション追加
        'name' => $_POST['cosme_name'],
        'color' => $_POST['color_name'],
        'colorId' => $_POST['colorSelect'],
        'brand' => $_POST['brandSelect'],
        'category' => $_POST['categorySelect'],
        'detail' => $_POST['cosme_detail'],
        'price' => $_POST['price'],
        'file' => $_FILES['file']['name'],
    ];
    $pdo = new PDO($connect, USER, PASS);
    $sql = $pdo -> prepare('select * from Cosmetics where cosme_name = ? and color_name = ?');
    $sql->execute([$_POST['cosme_name'],$_POST['color_name']]);
    if(!empty($sql->fetchAll())){   //登録済みのコスメ
        header('Location: ./k_cosme_new.php?page=1');
        exit();
    }
    $sql=$pdo->prepare('select group_id from Cosmetics where cosme_name = ?');
    $sql->execute([$_POST['cosme_name']]);
    $rowcount=$sql->rowCount();
    if($rowcount>=1){
        $group_id=$sql->fetchColumn();
        $rowcount++;
        $name=$group_id.'_'.$rowcount.'.jpg';
        $targetDir="image/";
        $fileName=basename($name);
        $targetFilePath=$targetDir.$fileName;
    }else{
        $sql2=$pdo->query('select max(group_id) from Cosmetics');
        $group_id=$sql2->fetchColumn();
        $group_id++;
        $name=$group_id.'_1.jpg';
        $targetDir="image/";
        $fileName=basename($name);
        $targetFilePath=$targetDir.$fileName;
    }
    if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFilePath)){
        $key=$_POST['colorSelect'];
    }else{
        $_SESSION['newCosme']['file'] = null;
        header('Location: ./k_cosme_new.php?page=2');
        exit();
    }
?>
<?php require 'k_header.php'; ?>
<h3>&cosme</h3>
<div id="center"><h2>商品登録確認</h2></div>
<div id="hr2"><hr color="black"></div>
<form action="k_cosme_finish.php" method="post" enctype="multipart/form-data">
    <?php
        $pdo=new PDO($connect, USER, PASS);
        $brand=$pdo->prepare('select brand_name from Brands where brand_id = ?');
        $brand->execute([$_POST['brandSelect']]);
        $brand_name=$brand->fetchColumn();
        $category=$pdo->prepare('select category_name from Categories where category_id = ?');
        $category->execute([$_POST['categorySelect']]);
        $category_name=$category->fetchColumn();
        $color=[1=>'レッド', 2=>'オレンジ', 3=>'ピンク', 4=>'ベージュ', 5=>'ホワイト', 6=>'ブラウン', 7=>'ブラック', 8=>'シルバー', 9=>'ゴールド', 10=>'その他'];
        $key=$_POST['colorSelect'];
        
        echo '<div id="center">';
        echo '<p><input type="text" name="cosme_name" value="',$_POST['cosme_name'],'" readonly></p>';
        echo '<p><input type="text" name="color_name" value="',$_POST['color_name'],'" readonly>　';
        echo '<input type="text" value="',$color[$key],'" readonly></p>';
        echo '<p><input type="text" value="',$brand_name,'" readonly>　';
        echo '<input type="text" value="',$category_name,'" readonly></p>';
        echo '<p><textarea name="cosme_detail" placeholder="',$_POST['cosme_detail'],'" rows="5" cols="40" readonly></textarea><p>';
        echo '<input type="number" name="price" value="',$_POST['price'],'"></p>';
        echo '<input type="text" value="',$_FILES['file']['name'],'">';
        echo '<div id="center">';
        echo '<p><font color="FF0000">ファイル名を「', $name, '」に変更して登録します。</font></p>';
        echo '</div>';
        
        //↓↓非表示↓↓
        echo '<input type="hidden" name="colorSelect" value="',$key,'">';
        echo '<input type="hidden" name="group_id" value="',$group_id,'">';
        echo '<input type="hidden" name="brandSelect" value="',$_POST['brandSelect'],'">';
        echo '<input type="hidden" name="categorySelect" value="',$_POST['categorySelect'],'">';
        echo '<input type="hidden" name="file" value="',$targetFilePath,'">';
        //↑↑非表示↑↑
        
        echo '<button type="submit" class="ao" style="width: 300px;height: 30px;">商品新規登録</button><br>';
        echo '</form>';
        echo '<form action="k_cosme_new.php?page=0" method="post">';
        echo '<input type="hidden" name="file" value="',$targetFilePath,'">';
        echo '<button type="submit" class="grey" style="width: 300px;height: 30px;" name="back">変更</button>';
        echo '</form>';
        echo '</div>';
        ?>
<?php require 'footer.php'; ?>