<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>DoctorWu留言本</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">多用户留言板</a>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <?php if (isset($_SESSION['id'])) : ?>
                            <li><a href="#"><?php echo $_SESSION['name'] ?></a></li>
                            <li><a href="user.php?m=logout">退出登录</a></li>
                        <?php  else : ?>
                            <li><a href="reg.php">注册</a></li>
                            <li><a href="login.php">登录</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>
    </div>
        <div class="col-md-3"></div>
    </div>

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading text-center">
                    <h3>发布留言</h3>
                    <form class="form-horizontal" method="post">
                        <div class="form-group">
                            <textarea class="form-control" rows="4" placeholder="文明发言" id="text" name="content"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-block"  id="submit">提交</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading text-center">
                    <h3>留言列表</h3>
                    <?php
                    ini_set('date.timezone','Asia/Shanghai');
                    require 'config.php';
                    $sql = "SELECT id,user_id,content,create_time FROM mess ORDER BY create_time DESC ";
                    if ($res = mysqli_query($db,$sql)) {
                        if (mysqli_num_rows($res) > 0) {
                            while ($temp = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                                $sql_name = "SELECT name FROM user WHERE id='{$temp['user_id']}'";
                                $name = mysqli_fetch_assoc(mysqli_query($db,$sql_name))['name'];
                                echo '<li class="list-group-item" style="border:none;">';
                                echo '<span>用户名:'.$name.'&nbsp;&nbsp;&nbsp;发布时间:'.date('Y年 m月 d日 H时 i分 s秒',$temp['create_time']).'</span><br>';
                                echo '<p>'.$temp['content'].'<p>';
                                echo '</li>';
                                echo'<hr>';


                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
<script>
    var btn = document.getElementById('submit')
    btn.onclick = function(){
        var text = document.getElementById('text').value
        var data = 'content='+text
        var xhr = new XMLHttpRequest()
        xhr.onreadystatechange = function(ev2){
            if (xhr.readyState == 4) {

                var json = JSON.parse(xhr.responseText)
                if (json.status == 1) {
                    alert('留言成功')
                    var li = document.createElement('li')
                    li.className = 'list-group-item'
                    li.style.border = 'none'
                    var list = document.getElementsByTagName('ul')[1].getElementsByTagName('li')
                    li.innerHTML = '<span>发布人: '+json.name+'&nbsp;&nbsp;&nbsp;发布时间:'+json.create_time+'</span><br>'+'<p>'+json.content+'</p>'
                    document.getElementsByTagName('ul')[1].insertBefore(li,list[0])
                }

            }
        }

        xhr.open('post','add.php',true)
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded')
        xhr.send(data)
        alert('留言成功')
        setTimeout(function () {
            window.location.href='index.php'
        },1000)
        return false
    }
</script>
</body>
</html>
