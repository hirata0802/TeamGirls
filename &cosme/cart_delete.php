<?php require 'db_connect.php'; ?>
<?php
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('update Cart set delete_flag=1 where cart_id=?');
    $sql->execute([$_GET['cartId']]);
    header('Location: ./cart.html');
    exit();
    
    /*$raw = file_get_contents('php://input');   //JSからのデータを受け取る
    $data = json_decode($raw);*/
echo '<div id="mannaka">';
echo 'カートから商品を削除しました。';
echo '</div>';
echo '<hr>';
?>
