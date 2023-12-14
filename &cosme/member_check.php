<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
    $_SESSION['members'] = [
        'sei' => $_POST['sei'],
        'mei' => $_POST['mei'],
        'seikana' => $_POST['seikana'],
        'meikana' => $_POST['meikana'],
        'nickname' => $_POST['nickname'],
        'zipcode' => $_POST['zipcode'],
        'prefecture' => $_POST['prefecture'],
        'city' => $_POST['city'],
        'address' => $_POST['address'],
        'bill' => $_POST['bill'],
        'tel' => $_POST['tel'],
        'mail' => $_POST['mail'],
        'pass' => $_POST['pass']
    ];
    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->prepare('select * from Members where email=?');
    $sql->execute([$_POST['mail']]);
    if(!empty($sql->fetchAll())){
        $_SESSION['members']['mail']=null;
        header('Location: ./member_new.php');
        exit();
    }
    require 'header.php';
    echo '<h3>&cosme</h3>';
    echo '<div id="hr2"><hr color="black"></div>';
    echo '<div id="logtitle"><h2>登録確認</h2></div>';
    
    echo '<form action="member_finish.php" method="post" id="next">';
        echo '<input type="hidden" name="sei" value="',$_POST['sei'],'">';
        echo '<input type="hidden" name="mei" value="',$_POST['mei'],'">';
        echo '<input type="hidden" name="seikana" value="',$_POST['seikana'],'">';
        echo '<input type="hidden" name="meikana" value="',$_POST['meikana'],'">';
        echo '<input type="hidden" name="nickname" value="',$_POST['nickname'],'">';
        echo '<input type="hidden" name="zipcode" value="',$_POST['zipcode'],'">';
        echo '<input type="hidden" name="prefecture" value="',$_POST['prefecture'],'">';
        echo '<input type="hidden" name="city" value="',$_POST['city'],'">';
        echo '<input type="hidden" name="address" value="',$_POST['address'],'">';
        echo '<input type="hidden" name="bill" value="',$_POST['bill'],'">';
        echo '<input type="hidden" name="tel" value="',$_POST['tel'],'">';
        echo '<input type="hidden" name="mail" value="',$_POST['mail'],'">';
        echo '<input type="hidden" name="pass" value="',$_POST['pass'],'">';

        echo '<table align="center">';
        //名前

        echo '<tr><td>';
        echo '<p align="center"><div id="simei">　　',$_POST['sei'],'　',$_POST['mei'],'(',$_POST['seikana'],'　',$_POST['meikana'],')</div></p>';
        echo '</td></tr>';
        //ニックネーム
        echo '<tr><td>';
        echo '<p align="center">',$_POST['nickname'],'</p>';
        echo '</td></tr>';
        //郵便番号
        echo '<tr><td>';
        echo '<p align="center"><div id="yuubin">　　',$_POST['zipcode'],'</div></p>';
        echo '</td></tr>';
        //住所
        echo '<tr><td>';
        echo '<p align="center">',$_POST['prefecture'],'　',$_POST['city'],'<br>';
        echo $_POST['address'],'<br>';
        echo $_POST['bill'],'</p>';
        echo '</tr></td>';
        //電話番号
        echo '<tr><td>';
        echo '<p align="center"><div id="tell">　　',$_POST['tel'],'</div></p>';
        echo '</tr></td>';
        //メールアドレス
        echo '<tr><td>';
        echo '<p align="center"><div id="meru2">　　',$_POST['mail'],'</div></p>';
        echo '</tr></td>';
        //パスワード
        echo '<tr><td>';
        echo '<p align="center"><div id="pas2">　　',$_POST['pass'],'</div></p>';
        echo '</tr></td>';
        echo '</table>';            
    echo '</form><br>';
    echo '<button type="button" onclick="location.href=`member_new.php`" class="grey">変更</button>'; 
    echo '<br>';
    echo '<button type="submit" form="next" class="ao">新規登録</button></p>';
    require 'footer.php';
?>