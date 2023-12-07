<?php session_start(); ?>
<?php 
if(!empty($_SESSION['customer'])){
    require 'header.php';
    require 'menu_home.php';
    require 'db_connect.php';
    
    echo '<table>';
        echo '👑今週のランキング';
        $pdo = new PDO($connect, USER, PASS);
        $sql = $pdo -> query('select * from OrderDetails as O join Cosmetics as C on O.cosme_id = C.cosme_id order by quantity desc limit 3');
        //$sql = $pdo -> query('select * from OrderDetails as O join Cosmetics as C on O.cosme_id = C.cosme_id group by O.cosme_id order by quantity desc limit 3');
        $count = 1;
        echo '<br>';
        echo '<br>';
        //順位
        echo '<table align="center" width="80%">';
        echo '<tr><td>1位</td> <td>2位</td> <td>3位</td></tr>';
        echo "</table>";
        //画像表示
        echo '<table width="100%">';
        echo '<tr>';
        foreach($sql as $row){
            echo '<td align="center"><a href="detail.php?cosme_id=',$row['cosme_id'],'"><img src="',$row['image_path'],'" widh="80" height="80"></a><br><font size="-1px"><div class="a">',$row['cosme_name'],'</div></font></td>';
        }
        echo '</tr>';
        echo '</table><br><br>';
        
        //新作情報
        $sql2 = $pdo -> query('select min(cosme_id), image_path, cosme_name from Cosmetics where creation_date >= date_add(now(), interval - 100 day) group by group_id'); 
        
        $count = 1;
        echo '⏰新作情報';
        echo '<table width="100%" cellpadding="10">';
        echo '<tr>';
        foreach($sql2 as $row2){
            if($count%4!=0){
                echo '<td align="center"><a href="detail.php?cosme_id=',$row2['min(cosme_id)'],'"><img src="',$row2['image_path'],'" widh="80" height="80"></a><br><font size="-1px">
                <div class="a">',$row2['cosme_name'],'</div></font></td>';
                //ｃｓｓ
            }else{
                echo '</tr><tr>';
            }
            $count++;
        }
        echo '</table>';
    echo '</table>';
    require 'footer.php';
    
}
else{
    echo 'このページを表示できません';
}
?>
