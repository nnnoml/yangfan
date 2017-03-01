@extends('app')
@section('content')
    <section class="rt_wrap content mCustomScrollbar">
        <div class="rt_content">
            <h1>{{$title}}</h1>

            <section>

                <input type="text" name="keywords" class="textbox" placeholder="关键词..." value="{{$key}}"/>
                <input type="button" value="查询" class="group_btn" id="search"/>
                <input type="button" value="重置" onClick="window.location.href='{{URL::to('admin/sellshop')}}'" class="group_btn"/>

            </section>
            <hr />
            <section>
                <div class="page_title">
                    <!--h2 class="fl">例如产品详情标题</h2-->
                    <a class="fr top_rt_btn" onClick="window.location.href='{{URL::to('admin/relation/create')}}'">新增关系</a>
                </div>
                <table class="table">
                    <tr>
                        <th>编号</th>
                        <th>购买店铺</th>
                        <th>销售店铺</th>
                        <th>是否启用</th>
                        <th>操作</th>
                    </tr>

                    @foreach ($data as $key=>$rs)
                        <tr>
                            <td>{{ $rs->id }}</td>
                            <td>{{ $rs->name }}</td>
                            <td>{{ $rs->area }}</td>
                            <td>@if($rs->start_time!=0){{ $rs->start_time }}/{{ $rs->end_time }}@else - @endif</td>
                            <td>{{ $rs->user_wechat }}</td>
                            <td>
                                <a href="{{URL::to('admin/buyshop')}}/{{ $rs->id }}/edit">修改</a>
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
            window.location.href="{{URL::to('admin/relation')}}?key="+key;
        })
    </script>
    </body>
    </html>
@endsection