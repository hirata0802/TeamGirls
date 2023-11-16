<?php require 'header.php'; ?>
<!--<?php require 'menu.php'; ?>-->
    <input type="text" name="name" placeholder="お届け先氏名" required>
    <p><input type="text" name="zipcode" id="zipcode" placeholder="郵便番号" required>
        <!---↓検索ボタンで住所自動入力-->
    <button type="button" class="ao" id="btn">検索</button></p>
    <p><input type="text" name="prefecture" id="prefecture" placeholder="都道府県" required></p>
    <p><input type="text" name="city" id="city" placeholder="市区町村" required></p>
    <p><input type="text" name="address" id="address" placeholder="番地" required></p>
    <p><input type="text" name="bill" placeholder="マンション・ビル名"></p>
    <p><input type="tel" name="tel" maxlength="11" pattern="^[0-9]+$" placeholder="電話番号" required></p>
    <input type="submit" value="追加" onclick="location.href='order_db_insert.php?order=0'">
<?php require 'footer.php'; ?>