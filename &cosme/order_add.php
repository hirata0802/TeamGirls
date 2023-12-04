<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
    <button onclick="history.back()">＜戻る</button>
    <form action="order_db_insert.php" method="post">
    <input type="text" name="name" placeholder="お届け先氏名" required>
    <p><input type="text" name="zipcode" id="zipcode" placeholder="郵便番号" required>
        <!---↓検索ボタンで住所自動入力-->
    <button type="button" class="ao" id="btn">検索</button></p>
    <p><input type="text" name="prefecture" id="prefecture" placeholder="都道府県" required></p>
    <p><input type="text" name="city" id="city" placeholder="市区町村" required></p>
    <p><input type="text" name="address" id="address" placeholder="番地" required></p>
    <p><input type="text" name="bill" placeholder="マンション・ビル名"></p>
    <p><input type="tel" name="tel" maxlength="11" pattern="^[0-9]+$" placeholder="電話番号" required></p>
    <input type="hidden" name="order" value="0">
    <button>追加</button>
    </form>
    <script src="./js/jquery-3.7.0.min.js"></script>
    <script src="./js/app.js"></script>
<?php require 'footer.php'; ?>