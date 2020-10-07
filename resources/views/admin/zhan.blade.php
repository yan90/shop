<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border>
        <tr>
            <td>id</td>
            <td>名称</td>
            <td>年龄</td>
            <td>操作</td>
        </tr>
        @foreach($admin as $v)
        <tr>
            <td>{{$v->c_id}}</td>
            <td>{{$v->account}}</td>
            <td>{{$v->age}}</td>
            <td>
                <a href="{{url('/admin/delete/'.$v->c_id)}}"> 删除</a>
                <a href="{{url('/admin/update/'.$v->c_id)}}">修改</a>
            </td>
            
                
            
        </tr>
        @endforeach
    </table>
</body>
</html>
