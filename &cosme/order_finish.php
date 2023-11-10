<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php
    echo '<h3>&cosme</h3>';
    echo '<hr>';
    echo '<h2>購入完了</h2>';
    echo '<p><font color="FF0000">', $_SESSION['customer']['familyName'], '　', $_SESSION['customer']['firstName'], '　様</font></p>';
    echo '<p><font color="FF0000">ご購入ありがとうございます。</font></p>';
    echo '<div class="ao"><button onclick="location.href=`home.php`">ホームへ</button></div>';
?>
<?php require 'footer.php'; ?>