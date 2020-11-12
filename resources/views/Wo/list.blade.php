<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="{{url('/wo/aaa')}}" method="post" enctype="multipart/form-data">
@csrf
<input type="file" name="img" ><br>
<input type="submit" value="提交"><br>

<input type="submit" value="退出"><br>


</form>
<img src="{{env('APP_URL')}}/storage/app/img/aaa.png" alt="" width="100px" height="100px">
<!-- <img src="/storage/img/aaa.jpg" alt=""> -->
</body>
</html>
