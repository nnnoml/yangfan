@extends('app')
@section('content')
    <section class="rt_wrap content mCustomScrollbar">
        <div class="rt_content">
            <h1>{{$title}}</h1>

            <section>

                <input type="text" name="keywords" class="textbox" placeholder="玩家昵称/玩家openid/订单号" value="{{$key}}"/>
                <input type="button" value="查询" class="group_btn" id="search"/>
                <input type="button" value="重置" onClick="window.location.href='{{URL::to('admin/cashflow')}}'" class="group_btn"/>

            </section>
            <hr />
            <section>
                <table class="table">
                    <tr>
                        <th>编号</th>
                        <th>用户名称</th>
                        <th>订单号</th>
                        <th>入账金额</th>
                        <th>创建时间</th>
                    </tr>

                    @foreach ($data as $key=>$rs)
                        <tr>
                            <td>{{ $rs->id }}</td>
                            <td>{{ $rs->nick }}({{ $rs->openid }})</td>
                            <td>{{ $rs->order_id }}</td>
                            <td>{{ $rs->price/100 }}元</td>
                            <td>{{ $rs->created_at }}</td>
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
            window.location.href="{{URL::to('admin/cashflow')}}?key="+key;
        })
    </script>

    </body>
    </html>
@endsection