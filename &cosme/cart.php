<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
  $pdo=new PDO($connect, USER, PASS);
  $sql=$pdo->prepare('select * from Cart as C inner join Cosmetics as CO on C.cosme_id=CO.cosme_id inner join Brands as B on CO.brand_id=B.brand_id where member_code=? and delete_flag=0');
  $sql->execute([$_SESSION['customer']['code']]);
  //$total=0;
  if($sql->rowCount() == 0){
    echo "レコードが有りません";
  }else{
    foreach ($sql as $row) {
      //$total += $row['price'] * $row['quantity'];
      $data[] = $row;
    }
    //値をjson形式で出力
    echo json_encode($data);
  }
?>