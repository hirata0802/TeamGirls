<?php session_start(); ?>
<?php
    if(!empty($_SESSION['customer'])){
        require 'header.php';
        require 'db_connect.php';
        echo `<button onclick="location.href='mypage.php'">＜戻る</button>`;
        echo '<div id="logtitle">';
        echo '<h2>ご注文履歴</h2>';
        echo '</div>';
        $pdo=new PDO($connect, USER, PASS);
        $sql=$pdo->prepare('select * from Orders where member_code=? order by order_date desc');
        $sql->execute([$_SESSION['customer']['code']]);
        //注文履歴表示
        foreach($sql as $row){
            echo '<div style="padding: 10px; margin-bottom: 10px; border: 1px solid #333333; border-radius: 10px;" class="history">';
            echo '<p>', $row['order_date'], '</p>';
            $sql2=$pdo->prepare('select * from OrderDetails OD inner join Cosmetics C on OD.cosme_id=C.cosme_id where OD.order_id=? order by C.cosme_id');
            $sql2->execute([$row['order_id']]);
            //注文詳細表示
            foreach($sql2 as $row2){
                echo '<table width="100%"><tr>';
                echo '<td><img src="', $row2['image_path'], '" alt="" style="object-fit: contain; width: 100px; height: 100px;"></td>';
                echo '<td align="left">';
                echo $row2['cosme_name'],'<br>';
                echo $row2['color_name'],'<br>';
                echo $row2['quantity'],'個</td></tr>';
                $reviewCount = $pdo -> prepare('select * from Reviews where cosme_id = ? and member_code = ?');
                $reviewCount -> execute([ $_GET['Rnew'],$_SESSION['customer']['code']]);
                //レビューを書いたことがないものだけ表示
                if($reviewcount->rowCount()==0){
                    echo '<tr><td colspan="2"><button class="ao" onclick="location.href=`review_new.php?Rnew=', $row2['cosme_id'], '&page=1`" id="buttonsize">レビューを書く</button></td></tr></table>';
                    echo '</div>';
                }
            }
            echo '<div id="mannaka">';
            echo $row['total_price'], '円<br>';
            echo $row['pay_method'];
            echo '</div>';
        }
        require 'footer.php';
    }
    else{
        echo 'このページを表示できません';
    }
?>