@extends('app')
@section('content')
    <section class="rt_wrap content mCustomScrollbar">
        <div class="rt_content">
            <h1>{{$title}}</h1>

            <section>
                <form id="data">
                    <ul class="ulColumn2">
                        <li>
                            <span class="item_name">产品名称：</span>
                            <input type="text" class="textbox" name="name" />
                        </li>

                        <li>
                            <span class="item_name">最大销售数量：</span>
                            <input type="text" class="textbox" name="max_num" value="-1"/>&nbsp;&nbsp;填-1则不限
                        </li>

                        <li>
                            <span class="item_name">产品描述：</span>
                            <textarea type="text" class="textbox textbox_295" style="height:100px;resize:none" name="desc" ></textarea>
                        </li>

                        <li>
                            <span class="item_name">是否上线：</span>
                            <label class="single_selection"><input type="radio" name="status" value='1'/>上线</label>
                            <label class="single_selection"><input type="radio" name="status" checked='true' value='0'/>不上线</label>
                        </li>

                        <li class="form-group">
                            <span class="item_name" style="width:120px;">图片上传：</span>
                            <input type="button" class="link_btn" id="click_btn" value="选择图片"/>
                            <input id="input_img_url" name="p_id" type="hidden"  value="">
                            <input id="upload_btn" type="file" name="file" >
                            <img  id="img_url" name="id" src="" />
                        </li>

                        <li>
                            <span class="item_name">是否限时：</span>
                            <label class="single_selection"><input type="radio" name="time_limit" value='1'/>限制</label>
                            <label class="single_selection"><input type="radio" name="time_limit" checked='true' value='0'/>不限</label>
                        </li>

                        <li style=" display:none" class="time_handle">
                            <span class="item_name">开始时间：</span>
                            <input type="text" class="textbox" id="start_time" name="start_time"  placeholder="请输入开始销售时间..." />
                        </li>

                        <li style=" display:none" class="time_handle">
                            <span class="item_name">结束时间：</span>
                            <input type="text" class="textbox" id="end_time" name="end_time"  placeholder="请输入结束销售时间..." />
                        </li>

                        <li>
                            <span class="item_name">单价：</span>
                            <input type="text" class="textbox" name="price" />&nbsp;&nbsp;单位 元，可精确到分
                        </li>

                        <li>
                            <span class="item_name">餐馆分成：</span>
                            <input type="text" class="textbox" name="seller_precent"/>&nbsp;&nbsp;单位 元，可精确到分
                        </li>

                        <li>
                            <span class="item_name">娱乐场所分成：</span>
                            <input type="text" class="textbox" name="buyer_precent"/>&nbsp;&nbsp;单位 元，可精确到分
                        </li>

                        <li>
                            <span class="item_name"></span>
                            <input type="button" class="link_btn" id="link_btn" value="提交"/>
                        </li>
                    </ul>
                </form>
            </section>

        </div>
    </section>
@endsection
@section('footer')
    <script src="{{asset('static/js/jquery.ajaxfileupload.js')}}"></script>
    <script>

        //上传图片相关
        function applyAjaxFileUpload(element) {
            $(element).AjaxFileUpload({
                action: "{{asset('/admin/sellgood/uploadImg')}}",
                onChange: function(filename) {
                    // Create a span element to notify the user of an upload in progress
                    var $span = $("<span />").attr("class", $(this).attr("id")).text("Uploading").insertAfter($(this));

                    $(this).remove();

                    interval = window.setInterval(function() {
                        var text = $span.text();
                        if (text.length < 13) {
                            $span.text(text + ".");
                        } else {
                            $span.text("Uploading");
                        }
                    }, 200);
                },
                onComplete: function(filename,result) {
                    window.clearInterval(interval);

                    var $span = $("span." + $(this).attr("id")).text("");
                    $("#input_img_url").val(result.name);
                    $("#img_url").attr('src',"{{asset('/')}}"+result.name);
                    $("#img_url").show();
                    $fileInput = $("<input />").attr({type: "file", name: $(this).attr("name"), id: $(this).attr("id")});
                }
            });
        }

        //上传图片相关
        $('#click_btn').on('click',function(){
            $('#upload_btn').trigger('click');
            applyAjaxFileUpload("#upload_btn");
        })

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
            $("#pic_url").attr('src',"{{asset('/')}}property/"+$(this).val()+".png");
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

        $("#link_btn").click(function(){
            var name = $("input[name = 'name']").val();
            var price = $("input[name = 'price']").val();
            var seller_precent = parseInt($("input[name = 'seller_precent']").val());
            var buyer_precent = parseInt($("input[name = 'buyer_precent']").val());

            var time_limit = $('input:radio[name=time_limit]:checked').val();
            var start_time = $("input[name = 'start_time'").val();
            var end_time = $("input[name = 'end_time'").val();

            if(name=='' || price=='')  showAlert('未填写完全','','');
            else if(time_limit==1 && end_time<start_time) showAlert('开始时间大于结束时间','','');
            else if((buyer_precent + seller_precent)>price) showAlert('分成比例填写错误','','');
            else{
                $.ajax({
                    url  : "{{URL::to('admin/sellgood')}}",
                    type : "post",
                    data : $("#data").serialize()+"&id={{$id}}&_token={{csrf_token()}}",
                    dataType: "json",
                    beforeSend:function(){
                        $(".loading_area").fadeIn();
                    },
                    success:function(result){
                        if(result.errorno==0){
                            $(".loading_area").fadeOut(1500);
                            showAlert(result.msg,'{{URL::to('admin/sellgood')}}/{{$id}}','{{URL::to('admin/sellgood')}}/{{$id}}');
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