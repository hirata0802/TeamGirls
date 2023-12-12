<?php
session_start();
if(empty($_SESSION['admin'])){
    header('Location: ./k_error.php');
    exit();
}
?>
<?php require 'k_header.php'; ?>
<?php require 'db_connect.php'; ?>
<?php
    $pdo=new PDO($connect, USER, PASS);
    $errormsg="";
    if(isset($_GET['page'])){
        if($_GET['page']==1){
            echo '<div id="center">';
            $errormsg='すでに登録された商品です';
        }else if($_GET['page']==2){
            $errormsg='ファイルのアップロードに失敗しました';
            echo '</div>';
        }
    }
    else{
        $_SESSION['newCosme'] = [
            'name' => null,
            'color' => null,
            'colorId' => null,
            'brand' => null,
            'category' => null,
            'detail' => null,
            'price' => null,
            'file' => null,
        ];
    }
    if(isset($_POST['back'])){
        $path1=$_POST['file'];
        if(unlink($path1)){
            $errormsg="";
        }
    }
?>

<h3>&cosme</h3>
<div id="center"><h2>商品登録</h2></div>
<div id="hr2"><hr color="black"></div>


<form action="k_cosme_check.php" method="post" enctype="multipart/form-data">
    <?php
    $pdo = new PDO($connect, USER, PASS);
    echo '<div id="center">';
    //エラー表示
    echo '<br><font color="FF0000">',$errormsg,'</font>';
    
    //商品名
    echo '<p><input type="text" class="ao" name="cosme_name" placeholder="商品名" value="', $_SESSION['newCosme']['name'], '" required></p>';
    
    //カラー名
    echo '<p><input type="text" class="ao"  name="color_name" placeholder="カラー名" value="', $_SESSION['newCosme']['color'], '" required>';
    
    //カラーID
    $color=[1=>'レッド', 2=>'オレンジ', 3=>'ピンク', 4=>'ベージュ', 5=>'ホワイト', 6=>'ブラウン', 7=>'ブラック', 8=>'シルバー', 9=>'ゴールド', 10=>'その他'];
    echo '<p><select name="colorSelect" class="as" required>';
    if(isset($_SESSION['newCosme']['color'])){
        foreach($color as $key => $value){
            if($_SESSION['newCosme']['color'] == $key){
                echo '<option value="',$key,'" selected hidden>',$value,'</option>';
            }
        }
        }else{
            echo '<option value="" selected hidden>カラーID</option>';
        }
        foreach($color as $key => $value){
            echo '<option value="',$key,'">',$value,'</option>';
        }
        echo '</select></p>';
        
        //ブランド名
        $sql=$pdo->query('select * from Brands');
        echo '<p><select name="brandSelect" class="as" required>';
        if(isset($_SESSION['newCosme']['brand'])){
            echo '<option value="',$_SESSION['newCosme']['brand'],'" selected hidden>',$_SESSION['newCosme']['brand'],'</option>';
        }else{
            echo '<option value="" selected hidden>ブランド名</option>';
        }
        foreach($sql as $row){
            echo '<option value="',$row['brand_id'],'">',$row['brand_name'],'</option>';
        }
        echo '</select></p>';

        //カテゴリ
        $sql=$pdo->query('select * from Categories');
        echo '<p><select name="categorySelect" class="as" required>';
        if(isset($_SESSION['newCosme']['category'])){
            echo '<option value="',$_SESSION['newCosme']['category'],'" selected hidden>',$_SESSION['newCosme']['category'],'</option>';
        }else{
            echo '<option value="" selected hidden>カテゴリー</option>';
        }
        foreach($sql as $row){
            echo '<option value="',$row['category_id'],'">',$row['category_name'],'</option>';
        }
        echo '</select></p>';
        
        //商品説明
        echo '<p><textarea name="cosme_detail" class="ao" placeholder="商品説明" rows="5" cols="40" maxlength="200" title="200文字以内で入力してください" required>', $_SESSION['newCosme']['detail'], '</textarea></p>';
        
        //値段
        echo '<p><input type="number" class="ao" name="price" placeholder="価格" min=0  value="', $_SESSION['newCosme']['price'], '" required></p>';
        
        //画像
        echo '<input type="file" name="file" accept=".jpg" required>';
        echo '</div>';
        ?>
    <br><button type="submit" class="next" >確認</button><br>
    <button onclick="location.href='k_home.php'" class="return" >ホームへ</button>
</form>
<?php require 'footer.php'; ?>