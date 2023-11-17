<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php require 'db_connect.php'; ?>
<form action="mypage_insert.php" method="post">
<?php
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('select * from Mypage where member_code=?');
    $sql->execute([$_SESSION['customer']['code']]);

    foreach($sql as $row){
        echo '<p>ニックネーム</p>';
        echo '<p><input type="text" name="nickname" value="', $row['member_nickname'], '"></p>';
        
        //佐伯のラベルを付け加える
        echo '<p>年代</p>';
        echo '<select name="age">';
        if($i<60){
            echo '<option value="', $row['member_age'], '" selected hidden>', $row['member_age'], '代</option>';
        }else{
            echo '<option value="', $row['member_age'], '" selected hidden>', $row['member_age'], '代以上</option>';
        }
        for($i=10; $i<=60; $i+=10){
            if($i<60){
                echo '<option value="', $i, '">', $i, '代</option>';
            }else{
                echo '<option value="', $i, '">', $i, '代以上</option>';
            }
        }        
        echo '</select>';
        
        echo '<p>性別</p>';
        echo '<select name="sei">';
        echo '<option value="', $row['member_gender'], '" selected hidden>', $row['member_gender'], '</option>';
        echo '<option value="女性">女性</option>';
        echo '<option value="男性">男性</option>';
        echo '<option value="その他">その他</option>';
        echo '</select>';
        
        echo '<p>肌質</p>';
        echo '<select name="skin">';
        echo '<option value="', $row['member_skin'], '" selected hidden>', $row['member_skin'], '</option>';
        echo '<option value="普通肌">普通肌</option>';
        echo '<option value="乾燥肌">乾燥肌</option>';
        echo '<option value="脂性肌">脂性肌</option>';
        echo '<option value="混合肌">混合肌</option>';
        echo '<option value="敏感肌">敏感肌</option>';
        echo '</select>';
        
        echo '<p>パーソナルカラー</p>';
        echo '<select name="p_color">';
        echo '<option value="', $row['member_color'], '" selected hidden>', $row['member_color'], '</option>';
        echo '<option value="イエベ">イエベ</option>';
        echo '<option value="ブルベ">ブルベ</option>';
        echo '</select>';
    }


    echo '<p><input type="submit" value="保存"></p>';
    echo '<p><a href="member_display.php">個人情報の変更はこちら</a></p>';
    echo '<p><a href="logout.php">ログアウト</a></p>';
?>
</form>
<?php require 'footer.php'; ?>
