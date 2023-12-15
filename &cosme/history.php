<?php session_start(); ?>
<?php
if(empty($_SESSION['customer'])){
    header('Location: ./error.php');
    exit();
}
?>
<?php require 'header.php'; ?>
<?php require 'db_connect.php'; ?>
    <button onclick="location.href='mypage.php'">＜戻る</button>
    <div id="logtitle">
        <h2>ご注文履歴</h2>
    </div>
    <?php
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('select * from Orders where member_code=? order by order_id desc');
    $sql->execute([$_SESSION['customer']['code']]);
    if($sql->rowCount() > 0){
        //注文履歴表示
        foreach($sql as $row){
            echo '<div style="padding: 10px; margin-bottom: 10px; border: 1px solid #333333; border-radius: 10px;" class="history">';
            echo '<p>', $row['order_date'], '</p>';
            $sql2=$pdo->prepare('select * from OrderDetails as OD inner join Cosmetics as C on OD.cosme_id=C.cosme_id where OD.order_id=?');
            $sql2->execute([$row['order_id']]);
            //注文詳細表示
            foreach($sql2 as $detail){
                echo '<table width="100%"><tr>';
                echo '<td width="100"><img src="', $detail['image_path'], '" alt="" style="object-fit: contain; width: 100px; height: 100px;"></td>';
                echo '<td>';
                echo '<strong>', $detail['cosme_name'],'</strong><br>';
                echo $detail['color_name'],'<br>';
                echo $detail['quantity'],'個';
                $reviewCount = $pdo -> prepare('select * from Reviews where cosme_id = ? and member_code = ?');
                $reviewCount -> execute([ $detail['cosme_id'],$_SESSION['customer']['code']]);
                //レビューを書いたことがないものだけ表示
                if($reviewCount->rowCount()==0){
                    echo '<button class="review" onclick="location.href=`review_new.php?Rnew=', $detail['cosme_id'], '&page=1`" id="buttonsize">レビューを書く</button>';
                }
                echo '</td></tr></table>';
            }
            echo '<br><hr class="tensen"><br>';
            echo '<div id="mannaka">';
            echo $row['total_price'], '円<br>';
            echo $row['pay_method'];
            echo '</div>';
            echo '</div>';
        }
    }
    else{
        echo '<div id="mannaka">ご注文履歴がありません。</div>';
    }
?>
<?php require 'footer.php'; ?>