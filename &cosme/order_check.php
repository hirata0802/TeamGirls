<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php require 'db_connect.php'; ?>
    <h2>注文内容の確認</h2>
    <form action="order_finish.html" method="post">
        <dl>
            <dt>お届け先：</dt><dd>〇〇〇〇様<br>
                            〒〇〇〇-〇〇〇〇<br>
                            〇〇県〇〇市〇〇〇〇</dd>
                            
            <dt>支払い方法： 現金</dt>
            
            <dt>商品合計</dt><dd>〇〇〇〇円</dd>
            <dt>品代</dt><dd>〇〇〇〇円</dd>
            <dt>送料</dt><dd>〇〇〇〇円</dd>
        </dl>
        <hr>
        <h3>合計（税込）〇〇〇〇円</h3>
        <div class="ao"><button type="submit">注文を確定する</button></div>
    </form>
    <div class="grey"><button onclick="location.href='order.html'">変更</button></div>
<?php require 'footer.php'; ?>