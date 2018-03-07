<?php
session_start();

require 'config.php';
switch ($_GET['m']){
    case 'add':
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $createtime = time();
        $sql = "INSERT INTO user SET name='{$name}',email='{$email}',password='{$password}',createtime='{$createtime}'";
        if (true ==mysqli_query($db,$sql)){
            echo '添加成功';
        }


    break;

    case 'login':
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT id,name,email,password FROM user WHERE email='{$email}' AND password='{$password}' LIMIT 1";
        if ($res = mysqli_query($db,$sql)) {
            if (mysqli_num_rows($res) == 1) {
                $user = mysqli_fetch_array($res, MYSQLI_ASSOC);
                $_SESSION['id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                echo 1;
            } else {
                echo 0;
            }
        }
        break;
    case 'logout':
        $_SESSION = [];
        setcookie(session_name(),'',time()-3600);
        echo '<script>window.location.href="index.php"</script>';
        break;
}
