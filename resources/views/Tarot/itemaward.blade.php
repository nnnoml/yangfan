@extends('app')
@section('content')
<section class="rt_wrap content mCustomScrollbar">
 <div class="rt_content">
     <h1>{{$title}}</h1>


<section>
      <h2><strong style="color:grey;">{{$title}}</strong></h2>
      <input type="text" name="keywords" class="textbox" placeholder="玩家账号..." value="{{$key}}"/>
      <input type="text" name="start_time" class="textbox textbox_225 laydate-icon" value="{{$start_time}}"  onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" placeholder="开始时间..."/>
      <input type="text" name="end_time" class="textbox textbox_225 laydate-icon" value="{{$end_time}}" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" placeholder="结束时间..."/>
      
      <select class="select" id="area_list">
       <option @if($area=='fengt') selected @endif value='fengt'>烽火十年</option>
       <option @if($area=='jings') selected @endif value='jings'>精灵圣地</option>
       <option @if($area=='qxing') selected @endif value='qxing'>七星烈焰</option>
       <option @if($area=='yxiong') selected @endif value='yxiong'>英雄圣殿</option>
      </select>

      <input type="button" value="查询" class="group_btn" id="search_log"/>
      <input type="button" value="重置" onClick="window.location.href='{{URL::to('Tarot/itemaward')}}'" class="group_btn"/>
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
        <th>玩家账号</th>
        <th>玩家区号</th>
        <th>道具id</th>
        <th>道具数量</th>
        <th>时间</th>
        <th>ip</th>
       </tr>

@foreach ($data as $key=>$logs)
       <tr>
       <td>{{ $logs->uid }}</td>
        <td>{{ $logs->login }}</td>
        <td>@if($area=='fengt') 烽火十年 
            @elseif($area=='jings') 精灵圣地
            @elseif($area=='qxing') 七星烈焰
            @elseif($area=='yxiong') 英雄圣殿
            @else -
            @endif
        </td>
        <td>{{ $logs->vnum }}</td>
        <td>{{ $logs->count }}</td>
        <td>{{ $logs->time }}</td>
        <td>{{ $logs->ip }}</td>
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
    var area = $("#area_list option:selected").val();
    if($(this).attr('id')=='excel')
      window.location.href="{{URL::to('Tarot/itemaward')}}?excel=1&key="+key+"&start_time="+start_time+"&end_time="+end_time+"&area="+area;
    else
      window.location.href="{{URL::to('Tarot/itemaward')}}?key="+key+"&start_time="+start_time+"&end_time="+end_time+"&area="+area;
  })
</script>

</body>
</html>
@endsection