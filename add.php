<?php
session_start();
$user_id = isset($_SESSION['id'])?$_SESSION['id']:'';
$content = $_POST['content'];
$create_time = time();
require 'config.php';
$sql = "INSERT INTO mess SET user_id='{$user_id}',content='{$content}',create_time='{$create_time}'";
if (mysqli_query($db,$sql)){

    $sql = "SELECT name FROM user WHERE id = {$user_id}";
    $name = mysqli_fetch_assoc(mysqli_query($db, $sql))['name'];
    echo json_encode(['status'=>1,'name'=>$name, 'create_time'=>date('Y 年 m月-d日 H时 i分 s秒',$create_time),'content'=>$content]);
} else {
    echo json_encode(['status'=>0,'info'=>'留言失败']);
}



