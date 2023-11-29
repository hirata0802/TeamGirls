<?php
    if(isset($_SESSION['customer'])){
        $pdo=new PDO($connect, USER, PASS);
        $sql=$pdo->prepare('select * from Reviews R inner join Mypage M on R.member_code=M.member_code where R.member_code=? and R.cosme_id=?');
        $sql->execute([$_SESSION['customer']['code'], $_GET['cosmeId']]);
        foreach($sql as $row){
            echo '<div style="padding: 10px; margin-bottom: 10px; border: 1px solid #333333; border-radius: 10px;">';
            echo '<p>', $row['cosme_name'], '　';
            for($i=0; $i<5; $i++){
                if($i<$row['level']){
                    echo '★';
                }
                else{
                    echo '☆';
                }
            }
            echo '</p>';
            echo '<p>', $row['nickname'], '　';
            echo $row['member_age'], '/';
            echo $row['member_skin'], '/';
            echo $row['member_color'], '</p>';
            echo '<p>', $row['review_text'], '</p>';
            if(!empty($row['image_path'])){
                echo '<img src="', $row['image_path'], '" alt="">';   
            }
            echo '</div>';            
        }
    }
?>