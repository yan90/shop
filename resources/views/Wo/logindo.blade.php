<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>{{session('msg')}}
    <form action="{{url('/wo/logindo2')}}" method="post">
    @csrf
    <h1>登录</h1>
    用户名：<input type="text" name="user_name"   placeholder="用户名/手机号/邮箱">
    <br>
    密码：<input type="password" name="password"><br>
    <input type="submit" value="登录">
    </form>
    
</body>
</html>