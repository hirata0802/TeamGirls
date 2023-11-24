<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php require 'db_connect.php'; ?>
<div class="modoru"><button onclick="location.href='detail.html'">戻る</button></div>
<h2>レビュー</h2>

<?php
    if(isset($_SESSION['customer'])){
        $pdo=new PDO($connect, USER, PASS);
        $sql=$pdo->prepare('select * from Reviews R inner join Mypage M on R.member_code=M.member_code where R.member_code=? and R.cosme_id=?');
        $sql->execute([$_SESSION['customer']['code'], $_GET['cosmeId']]);
        
        foreach($sql as $row){
            echo '<div style="padding: 10px; margin-bottom: 10px; border: 1px solid #333333; border-radius: 10px;">';
            echo '<p>商品名　★★★☆☆</p>';
            echo '<p>ニックネーム　10代/乾燥肌/イエベ</p>';
            echo '<p>本文</p>'
            echo '<img src="https://placehold.jp/120x100.png">';
            echo '</div>';
            
        }
        
    }
    
    ?>
<?php require 'footer.php'; ?>