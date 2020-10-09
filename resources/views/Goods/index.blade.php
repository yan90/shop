<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="save" method="post">
    @csrf
    名称：<input type="text" name="goods_name"><br>
        
        <select name="cat_id" id="">
            @foreach($PModelInfo as $k=>$v)
            <option value="{{$v->cat_id}}">{{$v->cat_name}}</option>
            @endforeach
        </select><br>
        <input type="submit" value="添加">
    </form>

</body>
</html>