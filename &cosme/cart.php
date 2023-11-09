<h2>カート</h2>
<form action="order.html" method="post">
<?php
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('select * from Cart where member_code=? and delete_flag=0 order by id desc');
    $sql->execute([$_SESSION['customer']['member_code']]);
    
    if($sql->fetch() == true){  //カートに追加しているか
        $total = 0;
        foreach($sql as $row){
            $sql2=$pdo->prepare('select * from Cart as C inner join Cosmetics as CO on C.cosme_id=CO.cosme_id inner join Brands as B on CO.brand_id=B.brand_id where member_code=? and delete_flag=0');
            $sql2->execute([$_SESSION['customer']['member_code']]);
            foreach($sql as $row){  //カートの中身表示
                echo '<img src="', $row['CO.image_path'], '">';
                echo '<p>ブランド名：', $row['B.brand_name'], '</p>';
                echo '<p>商品名：', $row['CO.cosme_name'], '</p>';
                echo '<p>価格：', $row['CO.price'], '</p>';
                echo '<p>カラー：', $row['CO.color_name'];
                echo '個数：';
                    //bluma使用
                echo '<button class="button is-small" @click="decrement">-1</button>';
                //echo '{{ count }}';
                echo '<button class="button is-small" @click="increment">+1</button>';
                echo '<input type="submit" href="cart-delete.php?id=', $row['C.cosme_id'], 'value="削除"></p>';
                //$total += $row['CO.price'] * count;
            }
        }
    }
    
    //CO.image_path, B.brand_name, CO.cosme_name, CO.price, CO.color_name, C.quantity
    
    echo '<hr>';
    echo '<p>合計金額：', $total, '</p>';
    echo '<p><div class="ao"><button type="submit">レジに進む</button></div></p>';
    echo '<input type="submit" value="レジに進む" onclick="location.href=`order.php`">';
?>
</form>
