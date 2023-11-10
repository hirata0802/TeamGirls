<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php require 'db_connect.php'; ?>
<h2>レジ</h2>
<form action="order_check.html" method="post">
<?php
    echo '<dl>'
    echo '<dt>商品合計</dt><dd>', $_POST['total'], '円</dd>';
    echo '<dt>お届け先</dt><dd>', $_SESSION['customer']['familyName'], '　' $_SESSION['customer']['firstName'], '　様<br>';
    echo '〒', $_SESSION['customer']['post'], '<br>';
        〇〇県〇〇市〇〇〇〇</dd>
        <dd><div class="white"><button type="submit">変更</button></div></dd>
        
        <dt>支払い方法</dt>
        <dd>
            <div class="radio-wrap">
                <input type="radio" name="test" value="現金">現金<br>
                <input type="radio" name="test" value="コンビニ払い">コンビニ払い<br>
                <input type="radio" name="test" value="クレジットカード">クレジットカード<br>
            </div>
            
        </dd>
    </dl>
    <hr>
    <div class="ao"><button type="submit">確認する</button></div>
</form>
<div class="grey"><button onclick="location.href='cart.html'">戻る</button></div>
<?php require 'footer.php'; ?>