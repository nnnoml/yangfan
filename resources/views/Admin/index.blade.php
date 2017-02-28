@extends('app')
@section('content')
<section class="rt_wrap content mCustomScrollbar">
 <div class="rt_content">
     <h1>{{$title}}</h1>
      <section>
      <!--tabCont-->
      <div class="admin_tab_cont" style="display:block;">
      <!--左右分栏：左侧栏目-->
       <div class="cont_col_lt mCustomScrollbar" style="height:500px;">
           <table class="table fl">
            <tr>
             <th>账号</th>
             <th>上次登录时间</th>
             <th>上次登录ip</th>
             <th>登录次数</th>
            </tr>
            <tr>
               <td class="center">{{$admin_info->name}}</td>
               <td class="center">{{$admin_info->updated_at}}</td>
               <td class="center">{{$admin_info->last_login_ip}}</td>
               <td class="center">{{$admin_info->login_count}}</td>
            </tr>
           </table>
       </div>
       <!--左右分栏：右侧栏-->
       <div class="cont_col_rt">
           <table class="table fl">
            <tr>
             <th>程序版本</th>
             <th>描述</th>
            </tr>
            <tr>
             <td class="center">倚天活动后台</td>
             <td>{{config('app.versionCMS')}}</td>
            </tr>
            <tr>
             <td class="center">操作系统</td>
             <td><?php echo PHP_OS ?></td>
            </tr>
           </table>
       </div>
      </div>
     </section>
    <!--结束：以下内容则可删除，仅为素材引用参考-->
 </div>
</section>
@endsection 
@section('footer')
</body>
</html>
@endsection 