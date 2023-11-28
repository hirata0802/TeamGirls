<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/style.css">
<title>&cosme</title>
</head>
<body>
<?php require 'db_connect.php'; ?>
<?php require 'menu.php'; ?>
    <form action="seach_output.php" method="post">
        <p align="center"><input type="text" name="keyword" placeholder="キーワードで検索">
        <input type="image" src="./image/seach.jpg" alt="検索" width="25px" formaction="seach_output.php?kubun=3&id=key'"></p>
        <hr width="70%">
        <h4 align="center">複数絞り込み</h4>
        <table width="50%" align="center">
            <tr >
                <th>カテゴリー</th><th>ブランド</th><th>カラー</th>
            </tr>
            <?php
            $pdo=new PDO($connect, USER, PASS);
            echo '<tr>';
                echo '<td align="center">';
                    echo '<label class="selectbox1">';
                        $sql=$pdo->query('select * from Categories');
                        echo '<select name="categorySelect">';
                            echo '<option value="0">選択しない</option>';
                            foreach($sql as $row){
                                echo '<option value="',$row['category_id'],'">',$row['category_name'],'</option>';
                            }
                        echo '</select>';
                    echo '</label>';
                echo '</td>';
                echo '<td align="center">';
                    echo '<label class="selectbox1">';
                        $sql=$pdo->query('select * from Brands');
                        echo '<select name="brandSelect">';
                            echo '<option value="0">選択しない</option>';
                            foreach($sql as $row){
                                echo '<option value="',$row['brand_id'],'">',$row['brand_name'],'</option>';
                            }
                        echo '</select>';
                    echo '</label>';
                echo '</td>';
                echo '<td align="center">';
                    echo '<label class="selectbox1">';
                    $color=[1=>'レッド', 2=>'オレンジ', 3=>'ピンク', 4=>'ベージュ', 5=>'ホワイト', 6=>'ブラウン', 7=>'ブラック', 8=>'シルバー', 9=>'ゴールド', 10=>'その他'];
                        echo '<select name="colorSelect">';
                            echo '<option value="0">選択しない</option>';
                            foreach($color as $key => $value){
                                echo '<option value="',$key,'">',$value,'</option>';
                            }
                        echo '</select>';
                    echo '</label>';
                echo '</td>';
                ?>
            </tr>
            <tr>
                <td colspan="3" align="center"><br>～　<input type="number" name="max" placeholder="￥99,999"></td>
            </tr>
            <tr>
                <td colspan="3"><br><button type="submit" class="ao" name="multiseach">検索</button></td>
            </tr>
        </table><br>
        <hr width="70%"><br>
        <?php
        echo '<table width="100%">';
            echo '<tr>';
                echo '<th colspan="3">カテゴリー</th>';
            echo '</tr>';
            $sql=$pdo->query('select * from Categories');
            $count=1;
            echo '<tr>';
            foreach($sql as $row){
                $category_id=$row['category_id'];
                if($count%3!=0){
                    echo '<td align="center"><input type="image" src="',$row['image_path'],'" alt="',$category_id,'" style="object-fit: contain; width="100px" height="100px" formaction="seach_output.php?kubun=1&id=',$category_id,'"><br>',$row['category_name'],'</td>';
                }else{
                    echo '<td align="center"><input type="image" src="',$row['image_path'],'" alt="',$category_id,'" style="object-fit: contain; width="100px" height="100px" formaction="seach_output.php?kubun=1&id=',$category_id,'"><br>',$row['category_name'],'</td>';
                    echo '</tr><tr>';
                }
                $count++;
            }
        echo '</table><br>';
        echo '<table width="100%">';
            echo '<tr>';
                echo '<th colspan="3">ブランド</th>';
            echo '</tr>';

            $sql=$pdo->query('select * from Brands');
            $count=1;
            echo '<tr>';
            foreach($sql as $row){
                $brand_id=$row['brand_id'];
                if($count%3!=0){
                    echo '<td align="center"><input type="image" src="',$row['brand_image_path'],'" alt="',$brand_id,'" style="object-fit: contain; width="100px" formaction="seach_output.php?kubun=2&id=',$brand_id,'"><br>',$row['brand_name'],'</td>';
                }else{
                    echo '<td align="center"><input type="image" src="',$row['brand_image_path'],'" alt="',$brand_id,'" style="object-fit: contain; width="100px" formaction="seach_output.php?kubun=2&id=',$brand_id,'"><br>',$row['brand_name'],'</td>';
                    echo '</tr><tr>';
                }
                $count++;
            }
        ?>
        </table>
    </form>
<?php require 'footer.php'; ?>
