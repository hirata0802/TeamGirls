<?php require 'db_connect.php'; ?>
<?php
    $pdo=new PDO($connect, USER, PASS);
    //order_add.php
    if($_POST['order'] == 0){
        $ads=$_POST['prefecture'].$_POST['city'].$_POST['address'].$_POST['bill'];
        $sql=$pdo->prepare('insert into Addresses values (null,?,?,?,?,?,CURRENT_DATE)');
        $sql->execute([
            $_SESSION['customer']['code'],
            $_POST['name'],
            $_POST['zipcode'],
            $ads,
            $_POST['tel'],
        ]);
        header('Location: ./order.php');
        exit();
    }
    //order_change.php
    else if($_POST['order'] == 1){
        $sql=$pdo->prepare('update Addresses set register_date=CURRENT_DATE where member_code=?');
        $sql->execute([$_SESSION['customer']['code']]);
        header('Location: ./order.php');
        exit();
    }
?>