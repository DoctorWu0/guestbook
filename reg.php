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
    <title>注册</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4>用户注册</h4>
                </div>
            </div>
            <form class="form-horizontal">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">用户:</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Username" onblur="checkName(this)">
                        <span id="tips1" class="text-warning"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">邮箱:</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" onblur="checkEmail(this)">
                        <span id="tips2" class="text-warning"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">密码:</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" onblur="checkPass(this)">
                        <span id="tips3" class="text-warning"></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" id="submit" class="btn btn-success">注 册</button>

                        <span id="tips4" class="text-info"></span>
                        <button type="button" id="login" class="btn btn-info" onclick="window.location.href='login.php'">登 录</button>


                    </div>
                </div>
            </form>

        </div>
        <div class="col-md-4"></div>
    </div>
</div>
<script>
    function checkName(name) {
        var tips1 = document.getElementById('tips1')
        if(name.value == ""){
          tips1.innerHTML = "用户名不能为空"
            name.focus()
        }else if(name.value.length < 3 || name.value.length > 10){
            tips1.innerHTML = "用户名在3-10位之间"
            name.focus()
        }else {
            tips1.innerHTML = '用户名可用'
        }
    }
    function checkEmail(email) {
        var tips2 = document.getElementById('tips2')
        if(email.value == ""){
            tips2.innerHTML = "邮箱不能为空"
            email.focus()
        }else if(email.value.length < 3 || email.value.length > 20){
            tips2.innerHTML = "邮箱格式不正确"
            email.focus()
        }else {
            tips2.innerHTML = '邮箱可用'
        }
    }
    function checkPass(password) {
        var tips3 = document.getElementById('tips3')
        if (password.value ==""){
            tips3.innerHTML = "密码不能为空"
            password.focus()
        }else if(password.value.length < 6 || password.value.length >20){
            tips3.innerHTML = "密码在6-20位之间"
        } else {
            tips3.innerHTML ="密码可用"
        }
    }
        var btn = document.getElementById('submit')
            btn.onclick = function (ev) {
                var name = document.getElementById('name').value
                var email = document.getElementById('email').value
                var password = document.getElementById('password').value
                var data = "name="+name+"&email="+email+"&password="+password
                var xhr = new XMLHttpRequest()
                xhr.onreadystatechange =function (ev2) {
                    if(xhr.readyState == 4 && xhr.status == 200){
                        var tips4 = document.getElementById('tips4')
                            tips4.innerHTML = xhr.responseText
                            setTimeout(function () {
                                window.location.href ='index.php'
                            },2000)


                    }
                }
                xhr.open('post','user.php?m=add',true)
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded')
                xhr.send(data)
                return false
            }
            var login = document.getElementById('login')

</script>
</body>
</html>
