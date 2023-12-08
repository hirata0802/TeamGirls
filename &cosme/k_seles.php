<?php require 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/k_style.css">
    <title>売上管理画面</title>
</head>
<body>
    <h3>&cosme</h3>
    <hr>
    <div id="center"><h1>売上管理画面</h1></div>
    <link rel="stylesheet" href="css/k_style.css">
    <p><button onclick="location.href='k_home.php'"class="ao" style="width: 150px;height: 30px;">ホームへ</button></p>
    <form action="k_seles.php" method="post">
        <div id="center">
        <input type="date" name="min">～<input type="date" name="max">
        <button type="submit">検索</button>
        </div>
    </form>
    <table border="1">
      <tr>
          <th>売上日</th><th>商品名</th><th>カラー名</th><th>売上金額</th><th>売上数</th>
      </tr>
    <?php
    $pdo=new PDO($connect, USER, PASS);
    if(!empty($_POST['min'])&&!empty($_POST['max'])){
        $sql=$pdo->prepare('select * from Orders where order_date between ? and ? order by order_date desc');
        $sql->execute([$_POST['min'],$_POST['max']]);
        foreach($sql as $row){
            echo '<tr>';
            $sql2=$pdo->prepare('select * from OrderDetails OD inner join Cosmetics C on OD.cosme_id = C.cosme_id where OD.order_id = ?');
            $sql2->execute([$row['order_id']]);
            foreach($sql2 as $row2){
                echo '<td>',$row['order_date'],'</td>';
                echo '<td>',$row2['cosme_name'],'</td>';
                echo '<td>',$row2['color_name'],'</td>';
                echo '<td>',$row2['price']*$row2['quantity'],'</td>';
                echo '<td>',$row2['quantity'],'</td>';
                echo '</tr>';
            }
            echo '</tr>';
        }
    }else if(!empty($_POST['min'])&&empty($_POST['max'])){
        $sql=$pdo->prepare('select * from Orders where order_date >= ? order by order_date desc');
        $sql->execute([$_POST['min']]);
        foreach($sql as $row){
            echo '<tr>';
            $sql2=$pdo->prepare('select * from OrderDetails OD inner join Cosmetics C on OD.cosme_id = C.cosme_id where OD.order_id = ?');
            $sql2->execute([$row['order_id']]);
            foreach($sql2 as $row2){
                echo '<td>',$row['order_date'],'</td>';
                echo '<td>',$row2['cosme_name'],'</td>';
                echo '<td>',$row2['color_name'],'</td>';
                echo '<td>',$row2['price']*$row2['quantity'],'</td>';
                echo '<td>',$row2['quantity'],'</td>';
                echo '</tr>';
            }
            echo '</tr>';
        }
    }else if(empty($_POST['min'])&&!empty($_POST['max'])){
        $sql=$pdo->prepare('select * from Orders where order_date <= ? order by order_date desc');
        $sql->execute([$_POST['max']]);
        foreach($sql as $row){
            echo '<tr>';
            $sql2=$pdo->prepare('select * from OrderDetails OD inner join Cosmetics C on OD.cosme_id = C.cosme_id where OD.order_id = ?');
            $sql2->execute([$row['order_id']]);
            foreach($sql2 as $row2){
                echo '<td>',$row['order_date'],'</td>';
                echo '<td>',$row2['cosme_name'],'</td>';
                echo '<td>',$row2['color_name'],'</td>';
                echo '<td>',$row2['price']*$row2['quantity'],'</td>';
                echo '<td>',$row2['quantity'],'</td>';
                echo '</tr>';
            }
            echo '</tr>';
        }
    }else{
        $sql=$pdo->query('select * from Orders order by order_date desc');
        foreach($sql as $row){
            echo '<tr>';
            $sql2=$pdo->prepare('select * from OrderDetails OD inner join Cosmetics C on OD.cosme_id = C.cosme_id where OD.order_id = ?');
            $sql2->execute([$row['order_id']]);
            foreach($sql2 as $row2){
                echo '<td>',$row['order_date'],'</td>';
                echo '<td>',$row2['cosme_name'],'</td>';
                echo '<td>',$row2['color_name'],'</td>';
                echo '<td>',$row2['price']*$row2['quantity'],'</td>';
                echo '<td>',$row2['quantity'],'</td>';
                echo '</tr>';
            }
            echo '</tr>';
        }
    }
    ?>
    </table>
</body>
</html>