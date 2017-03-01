@extends('app')
@section('content')
    <section class="rt_wrap content mCustomScrollbar">
        <div class="rt_content">
            <h1>{{$title}}</h1>

            <section>
                <form id="data">
                    <ul class="ulColumn2">
                        <li>
                            <span class="item_name" style="width:120px;">销售店铺选择：</span>
                            <input type="text" class="textbox textbox_295" name="ss_id" />
                        </li>

                        <li>
                            <span class="item_name" style="width:120px;">销售店铺选择：</span>
                            <input type="text" class="textbox textbox_295" name="bs_id" />
                        </li>

                        <li>
                            <span class="item_name" style="width:120px;">是否启用：</span>
                            <label class="single_selection"><input type="radio" name="status" checked='true' value='1'/>启用</label>
                            <label class="single_selection"><input type="radio" name="status" value='0'/>不启用</label>
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
            var bs_id = $("input[name = 'bs_id']").val();
            var ss_id = $("input[name = 'ss_id']").val();
            var status = $('input:radio[name=status]:checked').val();

            if(bs_id==0 || ss_id==0)  showAlert('未填写完全','','');
            else{
                $.ajax({
                    url  : "{{URL::to('admin/relation')}}",
                    type : "post",
                    data : $("#data").serialize()+"&_token={{csrf_token()}}",
                    dataType: "json",
                    beforeSend:function(){
                        $(".loading_area").fadeIn();
                    },
                    success:function(result){
                        if(result.errorno==0){
                            $(".loading_area").fadeOut(1500);
                            showAlert(result.msg,'{{URL::to('admin/relation')}}','{{URL::to('admin/relation')}}');
                        }
                        else {
                            $(".loading_area").fadeOut(1500);
                            showAlert(result.msg,'','');
                        }
                    }
                })
            }
        })
    </script>

    </body>
    </html>
@endsection