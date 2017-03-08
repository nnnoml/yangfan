@extends('app')
@section('content')
    <section class="rt_wrap content mCustomScrollbar">
        <div class="rt_content">
            <h1>{{$title}}</h1>

            <section>

                <input type="text" name="keywords" class="textbox" placeholder="玩家昵称/玩家openid" value="{{$key}}"/>
                <input type="button" value="查询" class="group_btn" id="search"/>
                <input type="button" value="重置" onClick="window.location.href='{{URL::to('admin/withdraw')}}'"
                       class="group_btn"/>

            </section>
            <hr/>
            <section>
                <table class="table">
                    <tr>
                        <th>编号</th>
                        <th>用户名称</th>
                        <th>提现金额</th>
                        <th>创建时间</th>
                        <th>状态</th>
                    </tr>

                    @foreach ($data as $key=>$rs)
                        <tr>
                            <td>{{ $rs->id }}</td>
                            <td>{{ $rs->nick }}({{ $rs->openid }})</td>
                            <td>{{ $rs->price/100 }}元</td>
                            <td>{{ $rs->created_at }}</td>
                            <td>
                                @if($rs->status==0)审核中
                                    <a href="javascript:;" onClick="ajax_withdraw('check',{{ $rs->id }})" class="inner_btn">审核</a>
                                    <a href="javascript:;" onClick="ajax_withdraw('pass',{{ $rs->id }})" class="inner_btn">驳回</a>
                                @elseif($rs->status==1)已提现 <a href="javascript:;" onClick="ajax_withdraw('reset',{{ $rs->id }})" class="inner_btn">重置</a>
                                @elseif($rs->status==2)已驳回 <a href="javascript:;" onClick="ajax_withdraw('reset',{{ $rs->id }})" class="inner_btn">重置</a>
                                @else -
                                @endif

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
        $("#search").click(function () {
            var key = $("input[name = 'keywords']").val();
            window.location.href = "{{URL::to('admin/withdraw')}}?key=" + key;
        })

        function ajax_withdraw(flag,id) {
            if(flag=='check')
                var res = confirm("确定审核该提现记录？");
            else if(flag=='pass')
                var res = confirm("确定驳回该提现记录？");
            else if(flag=='reset')
                var res = confirm("确定重置该提现记录？用户的钱会被加回去");

            if (res == true) {
                $.ajax({
                    url: "{{asset('/')}}admin/withdraw/"+id,
                    type: "PUT",
                    data: "flag=" + flag + "&_token={{csrf_token()}}",
                    dataType: "text",
                    beforeSend: function () {
                        $(".loading_area").fadeIn();
                    },
                    success: function (result) {
                        if (result == 1) {
                            $(".loading_area").fadeOut(1500);
                            showAlert('处理成功', '{{asset('/')}}admin/withdraw', '{{asset('/')}}admin/withdraw');
                        }
                        else {
                            $(".loading_area").fadeOut(1500);
                            showAlert('处理失败，请重试', '', '');
                        }
                    }
                })
            }
        }

    </script>

    </body>
    </html>
@endsection