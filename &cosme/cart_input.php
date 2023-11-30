<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
    $pdo = new PDO($connect,USER,PASS);
    if($_GET['page']==0){   //カート追加
        $check=$pdo->prepare('select * from Cart where member_code=? and cosme_id=? and delete_flag=0');
        $check->execute([$_SESSION['customer']['code'], $_GET['cosmeId']]);
        if($check->rowCount() == 0){
            $sql=$pdo->prepare('insert into Cart values (null, ?, ?, 1, 0)');
            $sql->execute([$_SESSION['customer']['code'], $_GET['cosmeId']]);
        }else{
            $sql=$pdo->prepare('update Cart set quantity=quantity+1 where member_code=? and cosme_id=? and delete_flag=0');
            $sql->execute([$_SESSION['customer']['code'], $_GET['cosmeId']]);
        }
    }
    else{   //個数の変更をDBに反映させる
        $raw = file_get_contents('php://input');   //JSからのデータを受け取る
        $data = json_decode($raw);
        $pdo=new PDO($connect, USER, PASS);
        $sql=$pdo->prepare('update Cart set quantity=? where member_code=? and cosme_id=? and delete_flag=0');
        $sql->execute([$data['quantity'], $_SESSION['customer']['code'], $data['cosme_id']]);
        echo 'a';
        header('Location: ./cart.html');
        exit();
    }
    $backURL = end($_SESSION['history']);
    header('Location: '.$backURL);
    exit();
    /*$jsonData = array_merge($jsonData, $data);  //配列を合体させて保存
    $jsonData = json_encode($jsonData);
    file_put_contents($jsonUrl, $jsonData);
            /*$raw=file_get_contents('php://input');
            $data=json_decode($raw);
            echo $data;*/
?>