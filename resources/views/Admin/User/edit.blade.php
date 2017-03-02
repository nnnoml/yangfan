@extends('app')
@section('content')
    <section class="rt_wrap content mCustomScrollbar">
        <div class="rt_content">
            <h1>{{$title}}</h1>

            <section>
                <form id="data">
                    <ul class="ulColumn2">
                        <li>
                            <span class="item_name" style="width:120px;">用户昵称：</span>
                            <input type="text" readonly class="textbox " name="nick" value="{{$data->nick}}"/>
                        </li>

                        <li>
                            <span class="item_name" style="width:120px;">用户头像：</span>
                            <input type="text" readonly class="textbox textbox_295" name="aratar" value="{{$data->avatar}}"/>
                            <img style="max-width:150px;" src="{{$data->avatar}}" />
                        </li>

                        <li>
                            <span class="item_name" style="width:120px;">是有分账权限：</span>
                            <label class="single_selection"><input type="radio" name="status" @if($data->status) checked='true' @endif value='1'/>拥有</label>
                            <label class="single_selection"><input type="radio" name="status" @if(!$data->status) checked='true' @endif value='0'/>未拥有</label>
                        </li>

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
            var status = $('input:radio[name=status]:checked').val();

                $.ajax({
                    url  : "{{URL::to('admin/user')}}/{{$data->id}}",
                    type : "PUT",
                    data : "status="+status+"&_token={{csrf_token()}}",
                    dataType: "json",
                    beforeSend:function(){
                        $(".loading_area").fadeIn();
                    },
                    success:function(result){
                        if(result.errorno==0){
                            $(".loading_area").fadeOut(1500);
                            showAlert(result.msg,'{{URL::to('admin/user')}}','{{URL::to('admin/user')}}');
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