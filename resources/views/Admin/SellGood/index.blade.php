@extends('app')
@section('content')
    <section class="rt_wrap content mCustomScrollbar">
        <div class="rt_content">
            <h1>{{$title}}</h1>

            <section>

                <input type="text" name="keywords" class="textbox" placeholder="关键词..." value="{{$key}}"/>
                <input type="button" value="查询" class="group_btn" id="search"/>
                <input type="button" value="重置" onClick="window.location.href='{{URL::to('admin/sellgood')}}'" class="group_btn"/>

            </section>
            <hr />
            <section>
                <div class="page_title">
                    <!--h2 class="fl">例如产品详情标题</h2-->
                    <a class="fr top_rt_btn" onClick="window.location.href='{{URL::to('admin/sellgood/create')}}?id={{$id}}'">新增产品</a>
                </div>
                <table class="table">
                    <tr>
                        <th>编号</th>
                        <th>产品名称</th>
                        <th>产品描述</th>
                        <th>产品价格(元)</th>
                        <th>产品图片</th>
                        <th>每天上限份数</th>
                        <th>上线时间/下线时间</th>
                        <th>是否上线销售</th>
                        <th>操作</th>
                    </tr>

                    @foreach ($goods_list as $key=>$rs)
                        <tr>
                            <td>{{ $rs->id }}</td>
                            <td>{{ $rs->name }}</td>
                            <td>{{ $rs->desc }}</td>
                            <td>{{ $rs->price/100 }}</td>
                            <td> <img style="max-width:100px;" src="{{asset('/')}}property/{{$rs->p_id}}.png" /></td>
                            <td>{{ $rs->max_num }}</td>
                            <td>@if($rs->start_time!=0){{ $rs->start_time }}/{{ $rs->end_time }}@else - @endif</td>
                            <td>@if($rs->status) 上线 @else 未上线 @endif</td>
                            <td>
                                <a href="{{URL::to('admin/sellgood')}}/{{ $rs->id }}/edit">修改</a>
                                {{--<a href="javascript:;" onClick='isdelete({{ $rs->id }})'>删除</a>--}}
                            </td>
                        </tr>
                    @endforeach

                </table>

                <aside class="paging">
                    {!! $goods_list->appends($searchitem)->render() !!}
                </aside>
            </section>


        </div>
    </section>

@endsection
@section('footer')
    <script>
        $("#search").click(function(){
            var key = $("input[name = 'keywords']").val();
            window.location.href="{{URL::to('admin/sellgood')}}/{{$id}}?key="+key;
        })
        function isdelete(id){
            var res=confirm("确定删除该店铺？");
            if(res==true){
                $.ajax({
                    url  : "{{URL::to('admin/sellgood')}}",
                    type : "delete",
                    data : "id="+id+"&_token={{csrf_token()}}",
                    dataType: "json",
                    beforeSend:function(){
                        $(".loading_area").fadeIn();
                    },
                    success:function(result){
                        if(result==1){
                            $(".loading_area").fadeOut(1500);
                            showAlert(result.errorno,'{{URL::to('admin/sellgood')}}/{{$id}}','{{URL::to('admin/sellgood')}}/{{$id}}');
                        }
                        else {
                            $(".loading_area").fadeOut(1500);
                            showAlert(result.errorno,'','');
                        }
                    }

                })

            }
        }
    </script>

    </body>
    </html>
@endsection