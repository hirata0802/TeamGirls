<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php require 'db_connect.php'; ?>
<button onclick="history.back()">＜戻る</button>
<form action="order_db_insert.php" method="post">
<?php
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('select * from Addresses where member_code=?');
    $sql->execute([$_SESSION['customer']['code']]);
    foreach($sql as $row){
        $ads=$row['prefecture'].$row['city'].$row['section'].$row['building'];
        echo '<input type="radio" name="address" value="', $row['address_id'], '">';
        echo '<dl>';
        echo '<dt>お届け先</dt><dd>', $row['address_name'], '　様<br>';
        echo '〒', $row['post_code'], '<br>';
        echo $ads, '<br>';
        echo $row['phone'], '</dd>';
    }
    ?>
<input type="hidden" name="order" value="1">
<button>選択</button>
</form>
<?php require 'footer.php'; ?>