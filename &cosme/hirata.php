if(!empty($sql->fetchAll())){  //カートに追加しているか
        $total = 0;
        $sql2->execute([$_SESSION['customer']['code']]);
        foreach($sql2 as $row){  //カートの中身表示
            echo '<img src="', $row['image_path'], '">';
            echo '<p>ブランド名：', $row['brand_name'], '</p>';
            echo '<p>商品名：', $row['cosme_name'], '</p>';
            echo '<p>価格：', $row['price'], '円</p>';
            echo '<p>カラー：', $row['color_name'];
            echo '個数：';
                //bluma使用

            echo '<button class="button is-small" @click="decrement">－</button>';
            echo '{{items.quantity}}';
            //echo '<input type="hidden" name="qty" :value="items.quantity">';
            //echo '<input type="number" name="count" :value="items.quantity">';
            echo '<button class="button is-small" @click="increment">＋</button>';
            $cart = $row['cart_id'];
            echo '<input type="submit" href="cart-delete.php?id=', $cart, '" value="削除"></p>';
            //$total += $row['CO.price'] * count;
        }
        echo '<hr>';
        echo '<p>合計金額：', $total, '</p>';
        echo '<p><div class="ao"><input type="submit" value="レジに進む" onclick="location.href=`order.php`"></div></p>';
    }
    
    //CO.image_path, B.brand_name, CO.cosme_name, CO.price, CO.color_name, C.quantity
 