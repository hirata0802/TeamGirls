<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>

<button onclick="history.back()">＜戻る</button>

<?php
    <h3>$_POST['cosme_name']</h3>
    // <div class="out">
    //     <div class="in">
    //         <label><input type=radio name="slide" checked><span></span><a href="#"><img src="" width="200"></a></label>
    //         <label><input type=radio name="slide"><span></span><a href="#"></a><img src="image/eyeliner.jpg" width="200"></label>
    //         <label><input type=radio name="slide"><span></span><a href="#"><img src="image/dior_syadou.jpg" width="200"></a></label>
    //         <label><input type=radio name="slide"><span></span><a href="#"><img src="image/eye.jpg" width="200"></a></label>
    //     </div>
    // </div>
?>
<body>
    <div class="modoru"><button onclick="location.href='seach_input.html'">＜戻る</button></div>
    <h3>商品名</h3>
    <div class="out">
        <div class="in">
            <label><input type=radio name="slide" checked><span></span><a href="#"><img src="" width="200"></a></label>
            <label><input type=radio name="slide"><span></span><a href="#"></a><img src="image/eyeliner.jpg" width="200"></label>
            <label><input type=radio name="slide"><span></span><a href="#"><img src="image/dior_syadou.jpg" width="200"></a></label>
            <label><input type=radio name="slide"><span></span><a href="#"><img src="image/eye.jpg" width="200"></a></label>
        </div>
    </div>

    <p>表示価格：<strong>￥3000</strong></p>
    <p>カラー：レッド</p>

   <a href="cart.html"><button>カートに入れる</button></a> 
    
    <p><strong>商品詳細</strong></p>
    <p>aaaaaaaaaaaaaaa</p>

    <p><strong>レビュー</strong></p>
    <form action="#" method="post">
        <input type="radio" name="detail" value="1">☆
        <input type="radio" name="detail" value="2">☆
        <input type="radio" name="detail" value="3">☆
        <input type="radio" name="detail" value="4">☆
        <input type="radio" name="detail" value="5">☆
        <div class="ao"><button type="submit">送信</button></div>
    </form> 

    <hr>
    <p>アカウント名</p>
    <p>レビュー詳細</p>

    <hr>
    <p>アカウント名</p>
    <p>レビュー詳細</p>
    <a href="review.html"><button>レビューをすべて見る＞</button></a>
    <a href="review_new.html"><button>レビューを書く＞</button></a>
</body>
</html>
