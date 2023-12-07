<?php
if(!empty($_SESSION['customer'])){
    require 'header.php';
    echo '<h3>&cosme</h3>';
    echo '<hr color="black">';
    echo '<form action="logout_finish.php" method="post">';
    echo '<div id="logtitle"><h2>ログアウト</h2></div>';
    echo '<div id="logtitle2"><h3>ログアウトしますか？</h3></div>';
    echo '<p><button class="ao" type="submit">ログアウト</button></p></div>';
    echo '<div hr1><hr width="250"></div><br>';
    echo '<div id="mannaka"><a href="mypage.php">＞マイページへ</a></div>';
    echo '</form>';
    require 'footer.php';

}
else{
    echo 'このページを表示できません';
}