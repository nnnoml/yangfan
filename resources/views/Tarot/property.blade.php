@extends('app')
@section('content')
<section class="rt_wrap content mCustomScrollbar">
 <div class="rt_content">
     <h1>{{$title}}</h1>

<section>

      <input type="text" name="keywords" class="textbox" placeholder="关键词..." value="{{$key}}"/>

      <select class="select" id="jiangchi">
       <option @if($jiangchi==0) selected @endif value='0'>全部奖池</option>
       <option @if($jiangchi==1) selected @endif value='1'>第一张牌奖池</option>
       <option @if($jiangchi==2) selected @endif value='2'>第二张牌奖池</option>
       <option @if($jiangchi==3) selected @endif value='3'>展示奖池</option>
      </select>
      <input type="button" value="查询" class="group_btn" id="search"/>
      <input type="button" value="重置" onClick="window.location.href='{{URL::to('Tarot/property')}}?area={{$area}}'" class="group_btn"/>

      <style>
       .group_btn_default{
            height: 30px;
            line-height: 30px;
            padding: 0 15px;
            border-radius: 2px;
            vertical-align: middle;
            cursor: pointer;
            border: 1px #19a97b solid;
            background: #f8f8f8;
            color: #19a97b;
       }
       .group_btn_now{
            border: 1px #139667 solid;
            background: #19a97b;
            color: #fff;
        }
      </style>
      <span style="float:right">
      <input type="button" value="烽火十年" onClick="window.location.href='{{URL::to('Tarot/property')}}?area=fengt'" class="group_btn_default @if($area=='fengt') group_btn_now @endif"/>
      <input type="button" value="精灵圣地" onClick="window.location.href='{{URL::to('Tarot/property')}}?area=jings'" class="group_btn_default @if($area=='jings') group_btn_now @endif"/>
      <input type="button" value="英雄圣殿" onClick="window.location.href='{{URL::to('Tarot/property')}}?area=yxiong'" class="group_btn_default @if($area=='yxiong') group_btn_now @endif"/>
      <input type="button" value="七星烈焰" onClick="window.location.href='{{URL::to('Tarot/property')}}?area=qxing'" class="group_btn_default @if($area=='qxing') group_btn_now @endif"/>
      </span>
      
</section>
<hr />
<section>
      <div class="page_title">
       <!--h2 class="fl">例如产品详情标题</h2-->
       <a class="fr top_rt_btn" onClick="window.location.href='{{URL::to('Tarot/propertyhandle')}}?area={{$area}}'">新增奖品</a>
      </div>
      <table class="table">
       <tr>
        <th>编号</th>
        <th>奖品名称</th>
        <th>奖品总数量</th>
        <th>奖品图片</th>
        <th>是否限时</th>
        <th>开始时间</th>
        <th>结束时间</th>
        <th>中奖概率</th>
        <th>指定抽取次数</th>
        <th>游戏内道具id</th>
        <th>游戏内道具数量</th>
        <th>分解基数/所得次数</th>
        <th>可否堆叠</th>
        <th>奖池</th>
        <th>操作</th>
       </tr>

@foreach ($data as $key=>$rs)
       <tr>
       <td>{{ $rs->id }}</td>
        <td>{{ $rs->item_title }}</td>
        <td>{{ $rs->item_num }}</td>
        <td> <img src="{{Config('app.static')}}/property/{{$rs->picture_id}}.png" /></td>
        <td>{{ $rs->is_time_limit }}</td>
        <td>{{ $rs->start_time }}</td>
        <td>{{ $rs->end_time }}</td>
        <td>{{ $rs->chance }}</td>
        <td>{{ $rs->limit_chance }}</td>
        <td>{{ $rs->property_id }}</td>
        <td>{{ $rs->property_num }}</td>
        <td>{{ $rs->slice_total_num }}/{{ $rs->slice_num }}</td>
        <td>@if($rs->is_pile) 可堆 @else 不可 @endif</td>
        <td>@if($rs->property_status == 1) 第一张牌奖池 @elseif($rs->property_status == 2) 第二张牌奖池 @elseif($rs->property_status == 3) 展示奖池 @else 未分类奖池 @endif</td>
        
        <td>
            <a href="{{URL::to('Tarot/propertyhandle')}}?id={{ $rs->id }}&area={{$area}}">修改</a>
            <a href="javascript:;" onClick='isdelete({{ $rs->id }})'>删除</a>
        </td>
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
    var jiangchi = $("#jiangchi option:selected").val();
    window.location.href="{{URL::to('Tarot/property')}}?key="+key+"&area={{$area}}&jiangchi="+jiangchi;
  })
  function isdelete(id){
     var res=confirm("确定删除该奖品？");
      if(res==true){
        $.ajax({
                url  : "{{URL::to('Tarot/deletedo')}}",
                type : "post",
                data : "id="+id+"&area={{$area}}&_token={{csrf_token()}}",
                dataType: "text",
                beforeSend:function(){
                        $(".loading_area").fadeIn();
                },
                success:function(result){
                        if(result==1){
                            $(".loading_area").fadeOut(1500);
                            showAlert('删除奖品成功','{{URL::to('Tarot/property')}}?area={{$area}}','{{URL::to('Tarot/property')}}?area={{$area}}');
                        }
                        else {
                            $(".loading_area").fadeOut(1500);
                            showAlert('删除失败，请重试','','');
                        }
                }

            })

      }
  }
</script>

</body>
</html>
@endsection