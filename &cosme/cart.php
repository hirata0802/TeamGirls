//カート画面
<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php require 'db_connect.php'; ?>
<h2>カート</h2>
<?php
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('select * from Cart where member_code=?');
    $sql->execute([$session['customer']['id']]);

<form action="order.html" method="post">
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
    </form>
<?php require 'footer.php'; ?>