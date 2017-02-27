@extends('app')
@section('content')
<section class="rt_wrap content mCustomScrollbar">
 <div class="rt_content">
     <h1>{{$title}}</h1>


<section>
      <h2><strong style="color:grey;">{{$title}}</strong></h2>
      <input type="text" name="keywords" class="textbox" placeholder="玩家名称/账号..." value="{{$key}}"/>
      <input type="text" name="start_time" class="textbox textbox_225 laydate-icon" value="{{$start_time}}"  onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" placeholder="开始时间..."/>
      <input type="text" name="end_time" class="textbox textbox_225 laydate-icon" value="{{$end_time}}" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" placeholder="结束时间..."/>
      <select class="select" id="status">
       <option @if($status==0) selected @endif value='0'>请选择</option>
       <option @if($status==1) selected @endif value='1'>注册</option>
       <option @if($status==2) selected @endif value='2'>消费</option>
       <option @if($status==3) selected @endif value='3'>翻牌</option>
       <option @if($status==4) selected @endif value='4'>领取</option>
       <option @if($status==5) selected @endif value='5'>分解</option>
       <option @if($status==6) selected @endif value='6'>抽1放弃</option>
       <option @if($status==7) selected @endif value='7'>抽2自动入暂存</option>
      </select>
      <input type="button" value="查询" class="group_btn" id="search_log"/>
      <input type="button" value="重置" onClick="window.location.href='{{URL::to('Tarot/log')}}'" class="group_btn"/>
      <input type="button" value="导出" class="group_btn" id="excel"/>
</section>

<section>
      <div class="page_title">
       <!--h2 class="fl">例如产品详情标题</h2>
       <a class="fr top_rt_btn">右侧按钮</a-->
      </div>
      <table class="table">
       <tr>
        <th>编号</th>
        <th>玩家名称/角色名</th>
        <th>玩家区号</th>
        <th>玩家行为</th>
        <th>状态</th>
        <th>时间</th>
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
        <td>{{ $logs->action }}</td>
        <td>@if($logs->status==0) - 
            @elseif($logs->status==1) 注册
            @elseif($logs->status==2) 消费
            @elseif($logs->status==3) 翻牌
            @elseif($logs->status==4) 领取
            @elseif($logs->status==5) 分解
            @elseif($logs->status==6) 抽1放弃
            @elseif($logs->status==7) 抽2自动
            @endif
        </td>
        <td>{{ $logs->time }}</td>
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
    var status = $("#status option:selected").val();
    if($(this).attr('id')=='excel')
      window.location.href="{{URL::to('Tarot/log')}}?excel=1&key="+key+"&start_time="+start_time+"&end_time="+end_time+"&status="+status;
    else
      window.location.href="{{URL::to('Tarot/log')}}?key="+key+"&start_time="+start_time+"&end_time="+end_time+"&status="+status;
  })
</script>

</body>
</html>
@endsection