<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{url('/wo/save')}}" method="get">
        @csrf
        <h1>注册</h1>
    用户名<input type="text" name="user_name"><br>
    手机号：<input type="text" name="tel"><br>
    邮箱<input type="email" name="email" ><br>
    密码<input type="password" name="password"><br>
    <input type="submit" value="注册">

    </form>
    
</body>
</html>