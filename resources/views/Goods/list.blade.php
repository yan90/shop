<table>
    <td>
        <tr>id</tr>
        <tr>名称</tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
    </td>
    @foreach($Goodes as $k=>$v)
    <td>
        <tr>{{$v->goods_id}}</tr>
        <tr>{{$v->}}</tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
    </td>
    @endforeach
</table>