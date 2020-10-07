<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{url('/admin/updatedo/'.$res->c_id)}}" method="post">
        @csrf
    名字 <input type="text" name="account" value="{{$res->account}}"><br>
        年龄 <input type="text" name='age' value="{{$res->age}}"><br>
        <input type="submit" value="修改">
    </form>
</body>
</html>