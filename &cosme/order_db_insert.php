<?php require 'db_connect.php'; ?>
<?php
    $pdo=new PDO($connect, USER, PASS);
    echo $order;
    /*if($order == 0){
        $ads=$_POST['prefecture'].$_POST['city'].$_POST['address'].$_POST['bill'];
        $sql=$pdo->prepare('insert into Addresses values (null,?,?,?,?,?,CURRENT_DATE)');
        $sql->execute([
            $_SESSION['customer']['code'],
            $_POST['name'],
            $_POST['zipcode'],
            $ads,
            $_POST['tel'],
        ]);

    }else if($order == 1){
        
    }*/
?>