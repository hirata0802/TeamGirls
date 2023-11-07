//カート画面
<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php require 'db_connect.php'; ?>
<h2>カート</h2>
<form action="order.html" method="post">
<?php
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('select * from Cart where member_code=? and delete_flag=0 order by id desc');
    $sql->execute([$_SESSION['customer']['id']]);
    
    if($sql->fetch() == true){
        foreach($sql as $row){
            $sql2=$pdo->prepare('select * from Cart as C inner join Cosmetics as CO on C.cosme_id=CO.cosme_id inner join Brands as B on CO.brand_id=B.brand_id where member_code=? and delete_flag=0');
            $sql2->execute([$_SESSION['customer']['id']]);
            foreach($sql as $row){
                echo '<img src="', $row['CO.image_path'], '">';
                echo '<p>ブランド名：', $row['B.brand_name'], '</p>';
                echo '<p>商品名：', $row['CO.cosme_name'], '</p>';
                echo '<p>価格：', $row['CO.price'], '</p>';
                echo '<p>カラー：', $row['CO.color_name'];
                echo '個数：', $row['C.quantity'], '</p>';
                echo '<input type="submit" value="削除">';
            }
        }
    }
    
    //CO.image_path, B.brand_name, CO.cosme_name, CO.price, CO.color_name, C.quantity
    <img src="https://placehold.jp/120x100.png">
    <p>ブランド名：〇〇〇〇</p>
    <p>商品名：〇〇〇〇</p>
    <p>価格：〇〇〇〇</p>
    カラー：〇
        個数：<select name="kazu">
            <option value="">1</option>
            <option value="">2</option>
            <option value="">3</option>
            <option value="">4</option>
            <option value="">5</option>
            <option value="">6</option>
            <option value="">7</option>
            <option value="">8</option>
            <option value="">9</option>
            <option value="">10</option>
            
        </select>
        <button type="submit">削除</button>

    <p><img src="https://placehold.jp/120x100.png"></p>
    <p>ブランド名：〇〇〇〇</p>
    <p>商品名：〇〇〇〇</p>
    <p>価格：〇〇〇〇</p>
    カラー：〇
        個数：<select name="kazu">
            <option value="">1</option>
            <option value="">2</option>
            <option value="">3</option>
            <option value="">4</option>
            <option value="">5</option>
            <option value="">6</option>
            <option value="">7</option>
            <option value="">8</option>
            <option value="">9</option>
            <option value="">10</option>
            
        </select>
        <button type="submit">削除</button>

        <hr>

        <p>合計金額:〇〇〇〇</p>
        <p><div class="ao"><button type="submit">レジに進む</button></div></p>
?>
</form>
<?php require 'footer.php'; ?>
