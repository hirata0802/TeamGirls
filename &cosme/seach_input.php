<?php require 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>seach</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
</head>
<body>
    <?php require 'menu.php'; ?>
    <form action="seach_output.php" method="post">
        <input type="text" name="keyword" placeholder="キーワードで検索">
        <button type="submit" class="fas fa-search"></button>
    <div id="seach">
        <?php
        echo '<table style="font-size:5pt">';
            echo '<tr>';
                echo '<th colspan=3>カテゴリー</th>';
            echo '</tr>';
            $pdo=new PDO($connect, USER, PASS);
            $sql=$pdo->query('select * from Categories');
            $count=1;
            echo '<tr>';
            foreach($sql as $row){
                $category_id=$row['category_id'];
                if($count%3!=0){
                    echo '<td><input type="image" src="',$row['image_path'],'" alt="',$category_id,'" width="60px" id="',$category_id,'"><br>',$row['category_name'],'</td>';
                }else{
                    echo '<td><input type="image" src="',$row['image_path'],'" alt="',$category_id,'" width="60px" id="',$category_id,'"><br>',$row['category_name'],'</td>';
                    echo '</tr><tr>';
                }
                $count++;
            }
        echo '</table>';
        echo '<table style="font-size:5pt">';
            echo '<tr>';
                echo '<th colspan=3>ブランド</th>';
            echo '</tr>';

            $sql=$pdo->query('select * from Brands');
            $count=1;
            echo '<tr>';
            foreach($sql as $row){
                $brand_id=$row['brand_id'];
                if($count%3!=0){
                    echo '<td><input type="image" src="',$row['image_path'],'" alt="',$brand_id,'" width="60px" id="',$brand_id,'"><br>',$row['brand_name'],'</td>';
                }else{
                    echo '<td><input type="image" src="',$row['image_path'],'" alt="',$bramd_id,'" width="60px" id="',$brand_id,'"><br>',$row['brand_name'],'</td>';
                    echo '</tr><tr>';
                }
                $count++;
            }
        echo '</table>';
        ?>
    </div>
    </form>
</body>
</html>
