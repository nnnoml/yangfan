@extends('app')
@section('content')
    <section class="rt_wrap content mCustomScrollbar">
        <div class="rt_content">
            <h1>{{$title}}</h1>

            <section>
                <form id="data">
                    <ul class="ulColumn2">
                        <li>
                            <span class="item_name" style="width:120px;">App名称：</span>
                            <input type="text" class="textbox textbox_295" name="title" value="@if(isset($site_config)){{$site_config->title}}@endif"/>
                        </li>

                        {{--<li>--}}
                            {{--<span class="item_name" style="width:120px;">微信AppID：</span>--}}
                            {{--<input type="text" class="textbox textbox_295" name="AppID" value="@if(isset($site_config)){{$site_config->AppID}}@endif"/>--}}
                        {{--</li>--}}

                        {{--<li>--}}
                            {{--<span class="item_name" style="width:120px;">微信AppSecret：</span>--}}
                            {{--<input type="text" class="textbox textbox_295" name="AppSecret" value="@if(isset($site_config)){{$site_config->AppSecret}}@endif"/>--}}
                        {{--</li>--}}

                        <li>
                            <span class="item_name" style="width:120px;"></span>
                            <input type="button" class="link_btn" value="提交"/>
                        </li>
                    </ul>
                </form>
            </section>

        </div>
    </section>

@endsection
@section('footer')
    <script>
        $(".link_btn").click(function(){
                $.ajax({
                    url  : "{{URL::to('admin/conf')}}",
                    type : "post",
                    data : $("#data").serialize()+"&type=add&_token={{csrf_token()}}",
                    dataType: "json",
                    beforeSend:function(){
                        $(".loading_area").fadeIn();
                    },
                    success:function(result){
                        if(result.errorno==0){
                            $(".loading_area").fadeOut(1500);
                            showAlert(result.msg,'{{URL::to('admin')}}','{{URL::to('admin')}}');
                        }
                        else {
                            $(".loading_area").fadeOut(1500);
                            showAlert(result.msg,'','');
                        }
                    }
                })
        })
    </script>
    </body>
    </html>
@endsection