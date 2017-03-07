@extends('app')
@section('content')
    <section class="rt_wrap content mCustomScrollbar">
        <div class="rt_content">
            <h1>{{$title}}</h1>

            <section>

                <input type="text" name="keywords" class="textbox" placeholder="玩家昵称/玩家openid" value="{{$key}}"/>
                <input type="button" value="查询" class="group_btn" id="search"/>
                <input type="button" value="重置" onClick="window.location.href='{{URL::to('admin/user')}}'" class="group_btn"/>

            </section>
            <hr />
            <section>
                <table class="table">
                    <tr>
                        <th>编号</th>
                        <th>用户名称</th>
                        <th>openid</th>
                        <th>用户头像</th>
                        <th>购买总次数/次</th>
                        <th>购买总金额/元</th>
                        <th>分账总额(元)/分账次数</th>
                        <th>账户目前余额(元)</th>
                        <th>是否有分账权限</th>
                        <th>操作</th>
                    </tr>

                    @foreach ($data as $key=>$rs)
                        <tr>
                            <td>{{ $rs->id }}</td>
                            <td>{{ $rs->nick }}</td>
                            <td>{{ $rs->openid }}</td>
                            <td><img style="max-width:100px;" src ="{{ $rs->avatar }}" /></td>
                            <td>{{ $rs->reserve_num }}次</td>
                            <td>{{ $rs->reserve_price/100 }}(元)</td>
                            <td>{{ $rs->account_sum/100 }}(元)/{{$rs->account_num}}次</td>
                            <td>{{ $rs->account_cash/100 }}(元)</td>
                            <td>@if($rs->status)有权限@else - @endif</td>
                            <td>
                                <a href="{{URL::to('admin/user')}}/{{ $rs->id }}/edit">修改</a>
                                {{--<a href="javascript:;" onClick='isdelete({{ $rs->id }})'>删除</a>--}}
                            </td>
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
            window.location.href="{{URL::to('admin/user')}}?key="+key;
        })
    </script>

    </body>
    </html>
@endsection