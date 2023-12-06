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
?>
<?php require 'header.php'; ?>
<h3>&cosme</h3>
<div id="hr2"><hr color="black"></div>
<div id="logtitle"><h2>登録確認</h2></div>

    <form action="member_finish.php" method="post" id="next">
        <?php
        echo '<input type="hidden" name="sei" value="',$_POST['sei'],'">';
        echo '<input type="hidden" name="mei" value="',$_POST['mei'],'">';
        echo '<input type="hidden" name="seikana" value="',$_POST['seikana'],'">';
        echo '<input type="hidden" name="meikana" value="',$_POST['meikana'],'">';
        echo '<input type="hidden" name="nickname" value="',$_POST['nickname'],'">';
        echo '<input type="hidden" name="zipcode" value="',$_POST['zipcode'],'">';
        echo '<input type="hidden" name="prefecture" value="',$_POST['prefecture'],'">';
        echo '<input type="hidden" name="city" value="',$_POST['city'],'">';
        echo '<input type="hidden" name="address" value="',$r_POST['address'],'">';
        echo '<input type="hidden" name="bill" value="',$_POST['bill'],'">';
        echo '<input type="hidden" name="tel" value="',$_POST['tel'],'">';
        echo '<input type="hidden" name="mail" value="',$_POST['mail'],'">';
        echo '<input type="hidden" name="pass" value="',$_POST['pass'],'">';

        echo '<table align="center">';
            echo '<tr><td>';
                echo '<p align="center"><div id="simei">　　',$_POST['sei'],'　',$_POST['mei'],'(',$_POST['seikana'],'　',$_POST['meikana'],')</div></p>';
            echo '</td></tr>';

            echo '<tr><td>';
                echo '<p align="center">',$_POST['nickname'],'</p>';
            echo '</td></tr>';

            echo '<tr><td>';
                echo '<p align="center"><div id="yuubin">　　',$_POST['zipcode'],'</div></p>';
            echo '</td></tr>';

            echo '<tr><td>';
                echo '<p align="center">',$_POST['prefecture'],'　',$_POST['city'],'　',$_POST['address'],'<br>';
                echo $_POST['bill'],'</p>';
            echo '</tr></td>';

            echo '<tr><td>';
                echo '<p align="center"><div id="tell">　　',$_POST['tel'],'</div></p>';
            echo '</tr></td>';

            echo '<tr><td>';
                echo '<p align="center"><div id="meru2">　　',$_POST['mail'],'</div></p>';
            echo '</tr></td>';


            echo '<tr><td>';
                echo '<p align="center"><div id="pas2">　　',$_POST['pass'],'</div></p>';
            echo '</tr></td>';
       echo '</table>';

       /*     echo '<table  align="center">';
            echo '<tr><td align="left">';
                echo '<div id="simei">';
                    echo '<p>姓名：',$_POST['sei'],'　　',$_POST['mei'],'</p>'; // style="width: 100px;height: 30px;"
                echo '</div>';
            echo '</td></tr>';

            echo '<tr><td align="left">';
                echo '<div id="mannaka">';
                    echo '<p text-align="left">セイメイ：',$_POST['seikana'],'　　',$_POST['meikana'],'</p>';// style="width: 125px;height: 30px;"
                echo '</div>';
            echo '</td></tr>';

            echo '<tr><td align="left">';
                echo '<div id="toroku0">';
                    echo '<p text-align="left">ニックネーム：',$_POST['nickname'],'</p>';// style="width: 260px;height: 30px;"
                echo '</div>';
            echo '</td></tr>';

            echo '<tr><td align="left">';
                echo '<div id="yuubin">';
                    echo '<p text-align="left">郵便番号：',$_POST['zipcode'],'</p>';// style="width: 240px;height: 27px;"
                echo '</div>';
            echo '</td></tr>';
            
            echo '<tr><td align="left">';
            echo '<div id="toroku1">';
                echo '<p>都道府県：',$_POST['prefecture'],'</p>';
            echo '</td></tr>';

                echo '<tr><td align="left">';
                    echo '<p>市区町村：',$_POST['city'],'</p>';
                echo '</td></tr>';

                echo '<tr><td align="left">';
                    echo '<p>番地：',$_POST['address'],'</p>';
                echo '</td></tr>';

                echo '<tr><td align="left">';
                    echo '<p>マンション・ビル名：',$_POST['bill'],'</p>';
                echo '</div>';
                echo '</td></tr>';
            
            echo '<tr><td align="left">';
                echo '<div id="tell">';
                    echo '<input type="hidden" name="tel" value="',$_POST['tel'],'">';
                    echo '<p>電話番号：',$_POST['tel'],'</p>';
                echo '</div>';
            echo '</td></tr>';
            echo '<br>';

            echo '<tr><td align="left">';
                echo '<div id="meru2">';
                    echo '<input type="hidden" name="mail" value="',$_POST['mail'],'">';
                    echo '<p>メールアドレス：',$_POST['mail'],'</p>';
                echo '</div>';
            echo '</td></tr>';
            echo '<br>';

            echo '<tr><td align="left">';
                echo '<div id="pas2">';
                    echo '<input type="hidden" name="pass" value="',$_POST['pass'],'">';
                    echo '<p>パスワード：',$_POST['pass'],'</p>';
                echo '</div>';
            echo '</td></tr>'; 
            echo '</table>';
        */
        ?>
    </form>
    <br>
    
     <button type="button" onclick="location.href='member_new.php'" class="grey">変更</button> 

    <button type="submit" form="next" class="ao">新規登録</button></p>
</body>
</html>
<?php require 'footer.php'; ?>