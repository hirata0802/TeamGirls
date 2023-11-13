<?php require 'header.php'; ?>
<?php require 'db_connect.php'; ?>
<?php require 'menu.php'; ?>
    <form action="seach_output.php" method="post">
        <input type="text" name="keyword" placeholder="キーワードで検索" >
        <input type="image" src="./image/seach.jpg" alt="検索" width="25px" formaction="seach_output.php?kubun=3&id=key'">
        <?php
        echo '<table width="100%">';
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
                    echo '<td align="center"><input type="image" src="',$row['image_path'],'" alt="',$category_id,'" width="100px" formaction="seach_output.php?kubun=1&id=',$category_id,'"><br>',$row['category_name'],'</td>';
                }else{
                    echo '<td align="center"><input type="image" src="',$row['image_path'],'" alt="',$category_id,'" width="100px" formaction="seach_output.php?kubun=1&id=',$category_id,'"><br>',$row['category_name'],'</td>';
                    echo '</tr><tr>';
                }
                $count++;
            }
        echo '</table>';
        echo '<table width="100%">';
            echo '<tr>';
                echo '<th colspan=3>ブランド</th>';
            echo '</tr>';

            $sql=$pdo->query('select * from Brands');
            $count=1;
            echo '<tr>';
            foreach($sql as $row){
                $brand_id=$row['brand_id'];
                if($count%3!=0){
                    echo '<td align="center"><input type="image" src="',$row['image_path'],'" alt="',$brand_id,'" width="100px" formaction="seach_output.php?kubun=2&id=',$brand_id,'"><br>',$row['brand_name'],'</td>';
                }else{
                    echo '<td align="center"><input type="image" src="',$row['image_path'],'" alt="',$brand_id,'" width="100px" formaction="seach_output.php?kubun=2&id=',$brand_id,'"><br>',$row['brand_name'],'</td>';
                    echo '</tr><tr>';
                }
                $count++;
            }
        echo '</table>';
        ?>
    </form>
<?php require 'footer.php'; ?>
