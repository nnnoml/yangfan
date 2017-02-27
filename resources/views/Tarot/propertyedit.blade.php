@extends('app')
@section('content')
<section class="rt_wrap content mCustomScrollbar">
 <div class="rt_content">
     <h1>{{$title}}</h1>

     <section>
     <form id="data">
      <ul class="ulColumn2">
       <li>
        <span class="item_name" style="width:120px;">奖品名称：</span>
        <input type="text" class="textbox textbox_295" name="title" value="{{$data->item_title}}"/>
       </li>

       <li>
        <span class="item_name" style="width:120px;">奖品数量：</span>
        <input type="text" class="textbox" name="num" value="{{$data->item_num}}"/>&nbsp;&nbsp;抽完就不会再中,填 -1 表示数量无限
       </li>

       <li>
        <span class="item_name" style="width:120px;">中奖几率：</span>
        <input type="text" class="textbox" name="chance" value="{{$data->chance}}"/>&nbsp;&nbsp; eg. 所有奖品几率之和为200，填2就表示本奖品中奖几率是2/200
       </li>

       <li>
        <span class="item_name" style="width:120px;">指定抽取次数：</span>
        <input type="text" class="textbox" name="limit_chance" value="{{$data->limit_chance}}"/>&nbsp;&nbsp; 抽取指定次数之后（含），该道具才参与随机
       </li>

       <li>
        <span class="item_name" style="width:120px;">分解基数：</span>
        <input type="text" class="textbox" name="slice_total_num" value="{{$data->slice_total_num}}"/>&nbsp;&nbsp; 该道具分解堆叠基数
       </li>

       <li>
        <span class="item_name" style="width:120px;">分解所得次数：</span>
        <input type="text" class="textbox" name="slice_num" value="{{$data->slice_num}}"/>&nbsp;&nbsp; 分解基数所得次数
       </li>

       <li>
        <span class="item_name" style="width:120px;">对应图片id：</span>
        <input type="text" class="textbox" name="pic_id" id="pic_id" value="{{$data->picture_id}}"/>
        <img id="pic_url" src="{{Config('app.static')}}/property/{{$data->picture_id}}.png" />
       </li>

       <li>
        <span class="item_name" style="width:120px;">对应游戏道具id：</span>
        <input type="text" class="textbox" name="property_id" value="{{$data->property_id}}"/> &nbsp;&nbsp; 填写0 为轮空道具
       </li>

       <li>
        <span class="item_name" style="width:120px;">对应游戏道具数量：</span>
        <input type="text" class="textbox" name="p_num" value="{{$data->property_num}}" />
       </li>

       <li>
        <span class="item_name" style="width:120px;">是否限时：</span>
        <label class="single_selection"><input type="radio" name="time_limit" @if($data->is_time_limit == '1') checked='true' @endif value='1'/>限制</label>
        <label class="single_selection"><input type="radio" name="time_limit" @if($data->is_time_limit == '0') checked='true' @endif value='0'/>不限</label>
       </li>

       <li @if($data->is_time_limit == '0') style=" display:none" @endif  class="time_handle">
        <span class="item_name" style="width:120px;">开始时间：</span>
        <input type="text" class="textbox textbox_295 laydate-icon" name="start_time" value="{{$data->start_time}}" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" placeholder="请输入活动开始时间..." />
       </li>

       <li @if($data->is_time_limit == '0') style=" display:none" @endif class="time_handle">
        <span class="item_name" style="width:120px;">结束时间：</span>
        <input type="text" class="textbox textbox_295 laydate-icon" name="end_time" value="{{$data->end_time}}" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" placeholder="请输入活动结束时间..." />
       </li>
       
       <li>
        <span class="item_name" style="width:120px;">是否可堆叠：</span>
        <label class="single_selection"><input type="radio" name="is_pile" @if($data->is_pile == '1') checked='true' @endif value='1'/>可堆叠</label>
        <label class="single_selection"><input type="radio" name="is_pile" @if($data->is_pile == '0') checked='true' @endif value='0'/>不可堆叠</label>
       </li>

       <li>
        <span class="item_name" style="width:120px;">奖池状态：</span>
        <label class="single_selection"><input type="radio" name="property_status" @if($data->property_status == '1') checked='true' @endif value='1'/>第一张牌奖池</label>
        <label class="single_selection"><input type="radio" name="property_status" @if($data->property_status == '2') checked='true' @endif value='2'/>第二张牌奖池</label>
        <label class="single_selection"><input type="radio" name="property_status" @if($data->property_status == '3') checked='true' @endif value='3'/>展示奖池</label>
       </li>

       <li>
        <span class="item_name" style="width:120px;"></span>
        <input type="button" class="link_btn" value="提交"/>
       </li>
      </ul>
     </section>

 </div>
</section>
</body>
</html>
@endsection
@section('footer')
<script src="{{config('app.static')}}/laydate/laydate.js"></script>
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

  $(".link_btn").click(function(){
    var title = $("input[name = 'title']").val();
    var num = $("input[name = 'num']").val();
    var chance = $("input[name = 'chance']").val();
    var pic_id = $("input[name = 'pic_id']").val();
    var property_id = $("input[name = 'property_id']").val();
    var p_num = $("input[name = 'p_num']").val();

    var time_limit = $('input:radio[name=time_limit]:checked').val();
    var start_time = $("input[name = 'start_time'").val();
    var end_time = $("input[name = 'end_time'").val();
    
       if(title=='' || num=='' || chance== '' || pic_id=='' || property_id== '' || p_num < 1)  showAlert('属性不能为空,对应道具数量不能少于1','','');
       else if(time_limit==1 && end_time<start_time)showAlert('开始时间大于结束时间','','');

        else{
            $.ajax({
                url  : "{{URL::to('Tarot/propertydo')}}",
                type : "post",
                data : $("#data").serialize()+"&id={{$data->id}}&type=edit&area={{$area}}&_token={{csrf_token()}}",
                dataType: "text",
                beforeSend:function(){
                        $(".loading_area").fadeIn();
                },
                success:function(result){
                        if(result==1){
                            $(".loading_area").fadeOut(1500);
                            showAlert('修改奖品成功','{{URL::to('Tarot/property')}}?area={{$area}}','{{URL::to('Tarot/property')}}');
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