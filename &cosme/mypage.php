<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
if(isset($_POST['nickname']) && isset($_POST['age']) && isset($_POST['sei']) && isset($_POST['skin']) && isset($_POST['p_color'])){
    $age=$sei=$skin=$p_color=NULL;
    if(!empty($_POST['age'])){
        $age = $_POST['age'];
    }
    if(!empty($_POST['sei'])){
        $sei = $_POST['sei'];
    }
    if(!empty($_POST['skin'])){
        $skin = $_POST['skin'];
    }
    if(!empty($_POST['p_color'])){
        $p_color = $_POST['p_color'];
    }
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('update Mypage set member_nickname=?, member_age=?, member_gender=?, member_skin=?, member_color=? where member_code=?');
    $sql->execute([
        $_POST['nickname'],
        $age,
        $sei,
        $skin,
        $p_color,
        $_SESSION['customer']['code']
    ]);
}
?>


<?php require 'header.php'; ?>
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
            <img src="css/image/favorite.svg" onclick="location.href='favorite_show.php'" width="40" height="40" alt="favorite">
            <div><font size="1">お気に入り</font></div>
        </li>
        <li>
            <img src="css/image/cart.svg" onclick="location.href='cart_show.php'" width="40" height="40" alt="cart">
            <div><font size="1">&nbsp;カート</font></div>
        </li>
        <li>
            <img src="css/image/mypage_black.svg" onclick="location.href='mypage.php'" width="40" height="40" alt="mypage">
            <div><font size="1">マイページ</font></div>
        </li>
    </ul>
</nav>
<form action="mypage.php" method="post">
<?php
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('select * from Mypage where member_code=?');
    $sql->execute([$_SESSION['customer']['code']]);
    echo '<div id="mannaka">';
    foreach($sql as $row){
        echo '<p>ニックネーム</p>';
        echo '<p><input type="text" class="nic" style="width: 230px;height: 40px;" name="nickname" value="', $row['member_nickname'], '"></p>';
        
        //佐伯のラベルを付け加える
        echo '<p>年代</p>';
        echo '<label class="selectbox">';
        echo '<select name="age">';
        $age = $row['member_age'];
        if($i>60){
            echo '<option value="', $row['member_age'], '" selected hidden>', $row['member_age'], '代以上</option>';
        }else{
            echo '<option value="', $row['member_age'], '" selected hidden>', $row['member_age'], '代</option>';
        }
        for($i=10; $i<=60; $i+=10){
            if($i<60){
                echo '<option value="', $i, '">', $i, '代</option>';
            }else{
                echo '<option value="', $i, '">', $i, '代以上</option>';
            }
        }        
        echo '</select>';
        echo '</label>';

        echo '<p>性別</p>';
        echo '<label class="selectbox">';
        echo '<select name="sei">';
        echo '<option value="', $row['member_gender'], '" selected hidden>', $row['member_gender'], '</option>';
        echo '<option value="女性">女性</option>';
        echo '<option value="男性">男性</option>';
        echo '<option value="その他">その他</option>';
        echo '</select>';
        echo '</label>';
        
        echo '<p>肌質</p>';
        echo '<label class="selectbox">';
        echo '<select name="skin">';
        echo '<option value="', $row['member_skin'], '" selected hidden>', $row['member_skin'], '</option>';
        echo '<option value="普通肌">普通肌</option>';
        echo '<option value="乾燥肌">乾燥肌</option>';
        echo '<option value="脂性肌">脂性肌</option>';
        echo '<option value="混合肌">混合肌</option>';
        echo '<option value="敏感肌">敏感肌</option>';
        echo '</select>';
        echo '</label>';
        
        
        echo '<p>パーソナルカラー</p>';
        echo '<label class="selectbox">';
        echo '<select name="p_color">';
        echo '<option value="', $row['member_color'], '" selected hidden>', $row['member_color'], '</option>';
        echo '<option value="イエベ">イエベ</option>';
        echo '<option value="ブルベ">ブルベ</option>';
        echo '</select>';
        echo '</label>';
    }


    echo '<p><input type="submit" value="保存"></p>';
    echo '<br>';
    echo '<p><a href="history.php">購入履歴</a></p>';
    echo '<p><a href="member_display.php">個人情報</a></p>';
    echo '<p><a href="logout.php">ログアウト</a></p>';
    echo '</div>';
?>
</form>
</body>
</html>
<?php require 'footer.php'; ?>