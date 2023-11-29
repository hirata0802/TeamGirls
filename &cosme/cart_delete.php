<?php require 'db_connect.php'; ?>
<?php
    $raw = file_get_contents('php://input');   //JSからのデータを受け取る
    $data = json_decode($raw);
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('update Cart set delete_flag=1 where cart_id=?');
    $sql->execute([$data['cart_id']]);
    header('Location: ./cart.html');
    exit();

echo 'カートから商品を削除しました。';
echo '<hr>';
?>
