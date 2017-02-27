@extends('app')
@section('content')
<section class="rt_wrap content mCustomScrollbar">
 <div class="rt_content">
     <h1>{{$title}}</h1>

     <section>
     <form id="data">
      <ul class="ulColumn2">
       <li>
        <span class="item_name" style="width:120px;">活动名称：</span>
        <input type="text" class="textbox textbox_295" name="title" value="{{$data->title}}"/>
       </li>

       <li>
        <span class="item_name" style="width:120px;">开始时间：</span>
        <input type="text" class="textbox textbox_295 laydate-icon" name="start_time" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" placeholder="请输入活动开始时间..." value="{{$data->start_time}}"/>
       </li>

       <li>
        <span class="item_name" style="width:120px;">结束时间：</span>
        <input type="text" class="textbox textbox_295 laydate-icon" name="end_time" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" placeholder="请输入活动结束时间..." value="{{$data->end_time}}"/>
       </li>
       
       <li>
        <span class="item_name" style="width:120px;">活动是否开启：</span>
        <label class="single_selection"><input type="radio" name="is_on_line" @if ($data->is_on_line == '1') checked="true" @endif value='1'/>上线</label>
        <label class="single_selection"><input type="radio" name="is_on_line" @if ($data->is_on_line == '0') checked="true" @endif value='0'/>下线</label>
       </li>

       <li>
        <span class="item_name" style="width:120px;">兑奖是否开启：</span>
        <label class="single_selection"><input type="radio" name="is_cash_property" @if ($data->is_cash_property == '1') checked="true" @endif value='1'/>开启</label>
        <label class="single_selection"><input type="radio" name="is_cash_property" @if ($data->is_cash_property == '0') checked="true" @endif value='0'/>关闭</label>
       </li>

       <li>
        <span class="item_name" style="width:120px;display: block;float: left;line-height: 120px;">活动描述：</span>
        <textarea placeholder="摘要信息" class="textarea" style="width:500px;height:100px;" name="desc">{{$data->desc}}</textarea>
       </li>

       <li>
        <span class="item_name" style="width:120px;display: block;float: left;line-height: 120px;">活动规则：</span>
        <textarea placeholder="摘要信息" class="textarea" style="width:500px;height:100px;" name="rule">{{$data->rule}}</textarea>
       </li>

       <li>
        <span class="item_name" style="width:120px;">单次消耗金币：</span>
        <input type="text" class="textbox" name="cost_gold_tiny" placeholder="单次消耗金币量..." value="{{$data->cost_gold_tiny}}"/>

        <span class="item_name" style="width:120px;">单次获得钥匙：</span>
        <input type="text" class="textbox" name="get_chance_tiny" placeholder="单次获得钥匙..." value="{{$data->get_chance_tiny}}"/>
       </li>

       <li>
        <span class="item_name" style="width:120px;">连续消耗金币：</span>
        <input type="text" class="textbox" name="cost_gold_bigger" placeholder="连续消耗金币量..." value="{{$data->cost_gold_bigger}}"/>

        <span class="item_name" style="width:120px;">连续获得钥匙：</span>
        <input type="text" class="textbox" name="get_chance_bigger" placeholder="连续获得钥匙..." value="{{$data->get_chance_bigger}}"/>
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
</body>
</html>
@endsection
@section('footer')
<script src="{{config('app.static')}}/laydate/laydate.js"></script>
<script>
  //登录view验证
  $(".link_btn").click(function(){

    var title = $("input[name = 'title']").val();
    var start_time = $("input[name = 'start_time']").val();
    var end_time = $("input[name = 'end_time']").val();
    var is_on_line = $('input:radio[name=is_on_line]:checked').val();
    var is_cash_property = $('input:radio[name=is_cash_property]:checked').val();
    var desc = $("textarea[name = 'desc']").val();
    var rule = $("textarea[name = 'rule']").val();

    
       if(title=='' || is_on_line=='' || is_cash_property=='' || desc=='' || rule=='')  showAlert('字段均不能为空','','');
       else if(start_time=='')  showAlert('开始时间不能为空','','');
       else if(end_time=='')  showAlert('结束时间不能为空','','');
       else if(end_time<start_time)  showAlert('开始时间大于结束时间','','');

        else{
            $.ajax({
                url  : "{{URL::to('Tarot/site')}}",
                type : "post",
                data : $("#data").serialize()+"&_token={{csrf_token()}}",
                dataType: "text",
                beforeSend:function(){
                        $(".loading_area").fadeIn();
                },
                success:function(result){
                        if(result==1){
                            $(".loading_area").fadeOut(1500);
                            showAlert('修改成功','{{URL::to('Tarot/index')}}','{{URL::to('Tarot/index')}}');
                        }
                        else {
                            $(".loading_area").fadeOut(1500);
                            showAlert('修改失败，请重试','','');
                        }
                        
                }

            })

        }
  })
</script>

</body>
</html>
@endsection