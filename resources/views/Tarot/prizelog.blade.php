@extends('app')
@section('content')
<section class="rt_wrap content mCustomScrollbar">
 <div class="rt_content">
     <h1>{{$title}}</h1>


<section>
      <h2><strong style="color:grey;">{{$title}}</strong></h2>
      <input type="text" name="keywords" class="textbox" placeholder="玩家名称/账号..." value="{{$key}}"/>
      <input type="text" name="start_time" class="textbox textbox_225 laydate-icon" value="{{$start_time}}"  onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" placeholder="中奖开始时间..."/>
      <input type="text" name="end_time" class="textbox textbox_225 laydate-icon" value="{{$end_time}}" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" placeholder="中奖结束时间..."/>

      <select class="select" id="param_status">
       <option @if($param_status=='id') selected @endif value=''>编号</option>
       <option @if($param_status=='prize_num') selected @endif value='prize_num'>中奖数量</option>
       <option @if($param_status=='change_num') selected @endif value='change_num'>兑换数量</option>
       <option @if($param_status=='fenjie_num') selected @endif value='fenjie_num'>分解数量</option>
      </select>

      <select class="select" id="order_status">
       <option @if($order_status=='asc') selected @endif value='asc'>升序</option>
       <option @if($order_status=='desc') selected @endif value='desc'>降序</option>
      </select>

      <input type="button" value="查询" class="group_btn" id="search_log"/>
      <input type="button" value="重置" onClick="window.location.href='{{URL::to('Tarot/prizelog')}}'" class="group_btn"/>
      <input type="button" value="导出" class="group_btn" id="excel"/>
</section>

<section>
      <div class="page_title">
       <!--h2 class="fl">例如产品详情标题</h2-->
       <!--a onClick="window.location.href='{{URL::to('Roll/prizelogcheat')}}'" class="fr top_rt_btn">虚假中奖信息</a-->
      </div>
      <table class="table">
       <tr>
        <th>编号</th>
        <th>玩家名称/角色名</th>
        <th>玩家区号</th>
        <th>奖品</th>
        <th>中奖数量</th>
        <th>兑换数量</th>
        <th>分解数量</th>
        <th>中奖时间</th>
       </tr>

@foreach ($data as $key=>$logs)
       <tr>
       <td>{{ $logs->id }}</td>
        <td>{{ $logs->user_name }}/{{ $logs->player_name }}</td>
        <td>@if($logs->area_id=='fengt') 烽火十年 
            @elseif($logs->area_id=='jings') 精灵圣地
            @elseif($logs->area_id=='qxing') 七星烈焰
            @elseif($logs->area_id=='yxiong') 英雄圣殿
            @else -
            @endif
        </td>
        <td>{{ $logs->item_title }}({{ $logs->item_property_id }})</td>
        <td>{{ $logs->prize_num }}</td>
        <td>{{ $logs->change_num }}</td>
        <td>{{ $logs->fenjie_num }}</td>
        <td>{{ $logs->prize_time }}</td>

       </tr>
@endforeach

      </table>
      
      <aside class="paging">
      {!! $data->appends($searchitem)->render() !!}
      </aside>
     </section>


 </div>
</section>
</body>
</html>
@endsection
@section('footer')
<script src="{{config('app.static')}}/laydate/laydate.js"></script>
<script>
  $("#search_log,#excel").click(function(){
    var key = $("input[name = 'keywords']").val();
    var start_time = $("input[name = 'start_time']").val();
    var end_time = $("input[name = 'end_time']").val();
    var param_status = $("#param_status option:selected").val();
    var order_status = $("#order_status option:selected").val();

    if($(this).attr('id')=='excel')
      window.location.href="{{URL::to('Tarot/prizelog')}}?excel=1&key="+key+"&start_time="+start_time+"&end_time="+end_time+"&param_status="+param_status+"&order_status="+order_status;
    else
      window.location.href="{{URL::to('Tarot/prizelog')}}?key="+key+"&start_time="+start_time+"&end_time="+end_time+"&param_status="+param_status+"&order_status="+order_status;
  })
</script>

</body>
</html>
@endsection