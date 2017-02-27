@extends('app')
@section('content')
<section class="rt_wrap content mCustomScrollbar">
 <div class="rt_content">
     <h1>{{$title}}</h1>


<section>
      <input type="text" name="keywords" class="textbox" placeholder="玩家角色名/玩家账号..." value="{{$key}}"/>
      <input type="button" value="查询" class="group_btn" id="search"/>
      <input type="button" value="重置" onClick="window.location.href='{{URL::to('Tarot/user')}}'" class="group_btn"/>
</section>
<hr />
<section>
      <div class="page_title">
       <!--h2 class="fl">例如产品详情标题</h2>
       <a class="fr top_rt_btn">右侧按钮</a-->
      </div>
      <table class="table">
       <tr>
        <th>编号</th>
        <th>玩家区号</th>
        <th>玩家账号</th>
        <th>玩家角色名</th>
        <th>总共进行的次数</th>
        <th>剩余钥匙</th>
       </tr>

@foreach ($data as $key=>$users)
       <tr>
       <td>{{ $users->id }}</td>
        <td>@if($users->area_id=='fengt') 烽火十年 
            @elseif($users->area_id=='jings') 精灵圣地
            @elseif($users->area_id=='qxing') 七星烈焰
            @elseif($users->area_id=='yxiong') 英雄圣殿
            @else -
            @endif
        </td>

        <td>{{ $users->user_name }}</td>
        <td>{{ $users->player_name }}</td>
        <td>{{ $users->total_play_num }}</td>
        <td>{{ $users->keys_num }}</td>
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
  $("#search").click(function(){
    var key = $("input[name = 'keywords']").val();
    window.location.href="{{URL::to('Tarot/user')}}?key="+key;
  })
</script>

</body>
</html>
@endsection