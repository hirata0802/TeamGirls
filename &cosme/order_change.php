<?php session_start(); ?>
<?php
if(empty($_SESSION['customer'])){
    header('Location: ./error.php');
    exit();
  }
?>
<?php require 'header.php'; ?>
<?php require 'db_connect.php'; ?>
<?php
    echo '<button onclick="history.back()">＜戻る</button>';
    echo '<form action="order_db_insert.php" method="post">';

    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('select * from Addresses where member_code=?');
    $sql->execute([$_SESSION['customer']['code']]);
    foreach($sql as $row){
        echo '<div id="text10">';
        $ads=$row['prefecture'].$row['city'].$row['section'].$row['building'];
        echo '<input type="radio" name="address" value="', $row['address_id'], '">';
        echo '<dl>';
        echo '<dt>お届け先</dt><dd>', $row['address_name'], '　様<br>';
        echo '〒', $row['post_code'], '<br>';
        echo $ads, '<br>';
        echo $row['phone'], '</dd>';
        echo '</div>';
    }
    echo '<input type="hidden" name="order" value="1">';
    echo '<div id="mannaka">';
    echo '<button class="ao">選択</button>';
    echo '</div>';
    echo '</form>';
?>
<?php require 'footer.php'; ?>