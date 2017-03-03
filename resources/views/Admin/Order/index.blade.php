@extends('app')
@section('content')
    <section class="rt_wrap content mCustomScrollbar">
        <div class="rt_content">
            <h1>{{$title}}</h1>

            <section>

                <input type="text" name="keywords" class="textbox" placeholder="玩家昵称/订单号" value="{{$key}}"/>
                <input type="button" value="查询" class="group_btn" id="search"/>
                <input type="button" value="重置" onClick="window.location.href='{{URL::to('admin/order')}}'" class="group_btn"/>

            </section>
            <hr />
            <section>
                <table class="table">
                    <tr>
                        <th>编号</th>
                        <th>用户名称</th>
                        <th>订单号</th>
                        <th>购买地址</th>
                        <th>商品名称</th>
                        <th>购买详情</th>
                        <th>创建时间</th>
                        <th>支付时间</th>
                        <th>支付状态</th>
                    </tr>

                    @foreach ($data as $key=>$rs)
                        <tr>
                            <td>{{ $rs->id }}</td>
                            <td>{{ $rs->nick }}</td>
                            <td>{{ $rs->order_id }}</td>
                            <td>{{ $rs->ss_name }}-{{$rs->machine_num}}</td>
                            <td>{{ $rs->sg_name }}</td>
                            <td>{{ $rs->order_num }}个 * {{ $rs->order_single_price/100 }}元 = {{$rs->order_cash/100}}元</td>
                            <td>{{ $rs->created_at }}</td>
                            <td>@if($rs->status){{ $rs->updated_at }}@else-@endif</td>
                            <td>@if($rs->status)已付@else未支付@endif</td>
                        </tr>
                    @endforeach

                </table>

                <aside class="paging">
                    {!! $data->appends($searchitem)->render() !!}
                </aside>
            </section>

        </div>
    </section>
@endsection
@section('footer')
    <script>
        $("#search").click(function(){
            var key = $("input[name = 'keywords']").val();
            window.location.href="{{URL::to('admin/order')}}?key="+key;
        })
    </script>

    </body>
    </html>
@endsection