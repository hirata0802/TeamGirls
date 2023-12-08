<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
if(empty($_SESSION['customer'])){
  header('Location: ./error.php');
  exit();
}
  $pdo=new PDO($connect, USER, PASS);
  //合計金額
  $sumPrice=$pdo->prepare('select sum(C.quantity * CO.price) as kei from Cart as C inner join Cosmetics as CO on C.cosme_id=CO.cosme_id inner join Brands as B on CO.brand_id=B.brand_id where member_code=? and delete_flag=0');
  $sumPrice->execute([$_SESSION['customer']['code']]);
  $total;
  foreach($sumPrice as $kei){
    $total = $kei['kei'];
  }
  $sql=$pdo->prepare('select * from Cart as C inner join Cosmetics as CO on C.cosme_id=CO.cosme_id inner join Brands as B on CO.brand_id=B.brand_id where member_code=? and delete_flag=0');
  $sql->execute([$_SESSION['customer']['code']]);
    foreach ($sql as $row) {
      $data[] = $row;
    }
    $data[] += $total;
    //値をjson形式で出力
    echo json_encode($data);
?>