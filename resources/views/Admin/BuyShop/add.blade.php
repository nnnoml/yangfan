@extends('app')
@section('content')
    <section class="rt_wrap content mCustomScrollbar">
        <div class="rt_content">
            <h1>{{$title}}</h1>

            <section>
                <form id="data">
                    <ul class="ulColumn2">
                        <li>
                            <span class="item_name" style="width:120px;">销售店铺名称：</span>
                            <input type="text" class="textbox textbox_295" name="name" />
                        </li>

                        <li>
                            <span class="item_name" style="width:120px;">坐标：</span>
                            <input type="text" class="textbox" placeholder="eg:116.377248,39.932863" name="area" value=""/>&nbsp;&nbsp;<a target="_blank" href="http://api.map.baidu.com/lbsapi/getpoint">拾取坐标</a>
                        </li>

                        <li>
                            <span class="item_name" style="width:120px;">微信收款用户：</span>
                            <select name="user_wechat">
                                <option value="">请选择用户</option>
                                {!!$shopkeeper_list!!}
                            </select>
                        </li>

                        <li>
                            <span class="item_name" style="width:120px;">是否限时：</span>
                            <label class="single_selection"><input type="radio" name="time_limit" value='1'/>限制</label>
                            <label class="single_selection"><input type="radio" name="time_limit" checked='true' value='0'/>不限</label>
                        </li>

                        <li style=" display:none" class="time_handle">
                            <span class="item_name" style="width:120px;">开始时间：</span>
                            <input type="text" class="textbox" id="start_time" name="start_time" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" placeholder="请输入营业开始时间..." />
                        </li>

                        <li style=" display:none" class="time_handle">
                            <span class="item_name" style="width:120px;">结束时间：</span>
                            <input type="text" class="textbox" id="end_time" name="end_time" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" placeholder="请输入营业结束时间..." />
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
        //是否限时奖品时间
        $('input:radio[name=time_limit]').click(function(){
            if($(this).val()==1){
                $(".time_handle").show();
            }
            else {
                $(".time_handle").hide();
            }
        });

        $("#pic_id").focusout(function(){
            $("#pic_url").attr('src',"{{Config('app.static')}}/property/"+$(this).val()+".png");
            $("#pic_url").show();
        })

        $(function(){
            $('#start_time , #end_time').timepicker({
                hourGrid: 4,
                minuteGrid: 10,
                secondGrid: 10,
                showSecond: true,
                timeFormat: 'hh:mm:ss'
            });
            $('#start_time ,#end_time').datepicker({
                changeYear:false,
                dateFormat: 'mm-dd'
            });
        });

        $(".link_btn").click(function(){
            var name = $("input[name = 'name']").val();
            var area = $("input[name = 'area']").val();

            var time_limit = $('input:radio[name=time_limit]:checked').val();
            var start_time = $("input[name = 'start_time'").val();
            var end_time = $("input[name = 'end_time'").val();

            if(name=='' || area=='')  showAlert('未填写完全','','');
            else if(time_limit==1 && end_time<start_time) showAlert('开始时间大于结束时间','','');
            else{
                $.ajax({
                    url  : "{{URL::to('admin/buyshop')}}",
                    type : "post",
                    data : $("#data").serialize()+"&_token={{csrf_token()}}",
                    dataType: "json",
                    beforeSend:function(){
                        $(".loading_area").fadeIn();
                    },
                    success:function(result){
                        if(result.errorno==0){
                            $(".loading_area").fadeOut(1500);
                            showAlert(result.msg,'{{URL::to('admin/buyshop')}}','{{URL::to('admin/buyshop')}}');
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