<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php require 'db_connect.php'; ?>
<?php
    //お届け先
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('select * from Addresses where member_code=? and register_date=(select max(register_date) from Addresses where member_code=?);');
    $sql->execute([$_SESSION['customer']['code'], $_SESSION['customer']['code']]);
    $address=$pdo->prepare('select * from Addresses where member_code=?');
    $address->execute([$_SESSION['customer']['code']]);
    foreach($sql as $row){
        $ads=$row['prefecture'].$row['city'].$row['section']. "\n" .$row['building'];
        echo '<dl>';
        echo '<div id="dai">';
        echo '<dt>お届け先</dt><dd>';
        echo '</div>';
        echo '<div id="text1">';
        echo $row['address_name'], '　様<br>';
        echo '〒', $row['post_code'], '<br>';
        echo $ads, '<br>';
        echo $row['phone'], '</dd>';
        echo '<dd><button class="todoke" type="submit" onclick="location.href=`order_add.php`">お届け先追加</button></div></dd>';
        if($address->rowCount() > 1){
            echo '<dd><button class="todoke" type="submit" onclick="location.href=`order_change.php`">お届け先変更</button></div></dd>';
           
        }
    }
    echo '</div>';
    echo '<br>';
    //商品合計
    $total=$pdo->prepare('select sum(C.quantity * CO.price) as total from Cart as C inner join Cosmetics as CO on C.cosme_id=CO.cosme_id inner join Brands as B on CO.brand_id=B.brand_id where member_code=? and delete_flag=0');
    $total->execute([$_SESSION['customer']['code']]);
    foreach($total as $row){
        echo '<div id="dai">';
        echo '<dt>商品合計</dt><dd>';
        echo '</div>';
        echo '<div id="text1">';
        echo  $row['total'], '円</dd>';
        echo '</div>';
    }
    echo '<form action="order_check.php" method="post">';
    echo '<input type="hidden" name="total" value="', $row['total'], '">';
?>
<br>
<div id="dai">
    <dt>お支払い方法</dt>
</div>
    <div id="text1">
    <div class="radio-wrap">
    <input type="radio" name="pay" value="現金払い" required>現金払い<br>
    <input type="radio" name="pay" value="コンビニ払い">コンビニ払い<br>
    <input type="radio" name="pay" value="クレジットカード払い">クレジットカード払い<br>
    </div>
    </div>
    </dl>
    <br>
    <hr class="tensen">
    <br>
    <button class="ao" type="submit">確認する</button></div>
    <br>
</form>
<button class="grey" onclick="location.href='cart.html'">戻る</button></div>
<?php require 'footer.php'; ?>
</body>
</html>