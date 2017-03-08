@extends('app')
@section('content')
    <section class="rt_wrap content mCustomScrollbar">
        <div class="rt_content">
            <h1>{{$title}}</h1>
            <section>

                <input type="text" name="keywords" class="textbox" placeholder="关键词..." value="{{$key}}"/>
                <input type="button" value="查询" class="group_btn" id="search"/>
                <input type="button" value="重置" onClick="window.location.href='{{URL::to('admin/relation')}}'" class="group_btn"/>

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
                        <th>娱乐场所</th>
                        <th>餐馆</th>
                        <th>是否启用</th>
                        <th>二维码</th>
                        <th>操作</th>
                    </tr>

                    @foreach ($data as $key=>$rs)
                        <tr>
                            <td>{{ $rs->id }}</td>
                            <td>{{ $rs->bs_name }}</td>
                            <td>{{ $rs->ss_name }}</td>
                            <td>@if($rs->status)启用@else 未启用 @endif</td>
                            <td><img src='data:image/png;base64,{!!base64_encode($rs->qrcode)!!}' /></td>
                            <td>
                                <a href="{{URL::to('admin/relation')}}/{{ $rs->id }}/edit">修改</a>
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