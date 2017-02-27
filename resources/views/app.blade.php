<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>{{config('app.title')}}</title>
    <meta name="author" content="DeathGhost"/>
    <link rel="stylesheet" type="text/css" href="{{config('app.static')}}/css/style.css"/>
    <!--[if lt IE 9]>
    <script src="js/html5.js"></script>
    <![endif]-->

</head>

<body>
<!--header-->
<header>
    <h1><img src="{{config('app.static')}}/images/admin_logo.png"/></h1>
    <ul class="rt_nav">
        <li><a href="{{URL::to('Main')}}" class="website_icon">系统首页</a></li>
        <!--li><a href="#" class="admin_icon">DeathGhost</a></li-->
        <li><a href="{{URL::to('User')}}" class="set_icon">用户设置</a></li>
        <li><a href="{{URL::to('Login/loginout')}}" class="quit_icon">安全退出</a></li>
    </ul>
</header>

<!--aside nav-->
<aside class="lt_aside_nav content mCustomScrollbar">
    <ul id="left_nav">
        <li>
            <dl>
                <dt>大转盘</dt>
                <dd><a href="{{URL::to('Roll/index')}}" @if ($nav == '1-1') class="active" @endif >活动配置</a></dd>
                <dd><a href="{{URL::to('Roll/config')}}" @if ($nav == '1-2') class="active" @endif >普通奖品池</a></dd>
                <dd><a href="{{URL::to('Roll/dajiang')}}"  @if ($nav == '1-3') class="active" @endif >行列大奖</a></dd>
                <dd><a href="{{URL::to('Roll/log')}}" @if ($nav == '1-4') class="active" @endif >日志列表</a></dd>
                <dd><a href="{{URL::to('Roll/prizelog')}}" @if ($nav == '1-5') class="active" @endif >获奖日志</a></dd>
            </dl>
        </li>

        <li>
            <dl>
                <dt>塔罗牌</dt>
                <dd><a href="{{URL::to('Tarot/index')}}" @if ($nav == '2-1')  class="active" @endif >活动配置</a></dd>
                <dd><a href="{{URL::to('Tarot/property')}}"  @if ($nav == '2-2') class="active" @endif >奖品池</a></dd>
                <dd><a href="{{URL::to('Tarot/user')}}" @if ($nav == '2-3') class="active" @endif >用户列表</a></dd>
                <dd><a href="{{URL::to('Tarot/log')}}" @if ($nav == '2-4') class="active" @endif >日志列表</a></dd>
                <dd><a href="{{URL::to('Tarot/prizelog')}}"  @if ($nav == '2-5') class="active" @endif >获奖日志</a></dd>
                <dd><a href="{{URL::to('Tarot/itemaward')}}"  @if ($nav == '2-6') class="active" @endif >游戏背包</a></dd>
            </dl>
        </li>

        <li>
            <dl>
                <dt>锻造黄金装</dt>
                <dd><a href="{{URL::to('Forge/site')}}"  @if ($nav == '3-1') class="active" @endif >活动配置</a></dd>
                <dd><a href="{{URL::to('Forge/property')}}" @if ($nav == '3-2') class="active"  @endif >奖品池</a></dd>
                <dd><a href="{{URL::to('Forge/user')}}"  @if ($nav == '3-3') class="active"  @endif >用户列表</a></dd>
                <dd><a href="{{URL::to('Forge/log')}}" @if ($nav == '3-4')  class="active"  @endif >日志列表</a></dd>
                <dd><a href="{{URL::to('Forge/prizelog')}}" @if ($nav == '3-5')  class="active" @endif >获奖日志</a></dd>
                <dd><a href="{{URL::to('Forge/cheat')}}" @if ($nav == '3-6') class="active"  @endif >虚拟抽奖</a></dd>
                <dd><a href="{{URL::to('Forge/changeproperty')}}" @if ($nav == '3-7') class="active" @endif >下抽必中</a></dd>
            </dl>
        </li>

        <li>
            <dl>
                <dt>幸运福袋</dt>
                <dd><a href="{{URL::to('Bag/site')}}"  @if ($nav == '4-1') class="active" @endif >活动配置</a></dd>
                <dd><a href="{{URL::to('Bag/bagchance')}}"  @if ($nav == '4-2') class="active" @endif >福袋配置</a></dd>
                <dd><a href="{{URL::to('Bag/property')}}"  @if ($nav == '4-3') class="active" @endif >奖品配置</a></dd>
                <dd><a href="{{URL::to('Bag/user')}}"  @if ($nav == '4-4') class="active" @endif >用户列表</a></dd>
                <dd><a href="{{URL::to('Bag/cheat')}}"  @if ($nav == '4-5') class="active" @endif >虚拟抽奖</a></dd>
                <dd><a href="{{URL::to('Bag/changepool')}}"  @if ($nav == '4-6') class="active" @endif >下抽必中</a></dd>
                <dd><a href="{{URL::to('Bag/log')}}"  @if ($nav == '4-7') class="active" @endif >行为日志</a></dd>
                <dd><a href="{{URL::to('Bag/prizelog')}}"  @if ($nav == '4-8') class="active" @endif >获奖日志</a></dd>

            </dl>
        </li>

        <li>
            <dl>
                <dt>工具类</dt>
                <dd><a href="{{URL::to('Common/gameaward')}}" @if ($nav == '10-1') class="active" @endif >玩家背包查询</a></dd>
                <dd><a href="{{URL::to('Common/usercash')}}" @if ($nav == '10-2') class="active" @endif >用户金币查询</a></dd>
                <dd><a href="{{URL::to('Common/mallselllist')}}" @if ($nav == '10-3') class="active" @endif >商城销售查询</a></dd>
            </dl>
        </li>

        <!--li>
         <dl>
          <dt>在线统计</dt>
          <dd><a href="#">流量统计</a></dd>
          <dd><a href="#">销售额统计</a></dd>
         </dl>
        </li>
        <li>
         <dl>
          <dt>在线统计</dt>
         </dl>
        </li-->

    </ul>

</aside>
<p class="fix_btm_infor">{{config('app.title')}} | {{config('app.copyright')}} | {{config('app.versionCMS')}}</p>
<!--全屏遮罩-->
<section class="loading_area">
    <div class="loading_cont">
        <div class="loading_icon"><i></i><i></i><i></i><i></i><i></i></div>
        <div class="loading_txt">
            <mark>数据正在加载，请稍后！</mark>
        </div>
    </div>
</section>
<!--全屏遮罩-->

<!--弹出提示框-->
<section class="pop_bg">
    <div class="pop_cont">
        <!--title-->
        <h3>{{config('app.title')}}</h3>
        <!--以pop_cont_text分界-->
        <div class="pop_cont_text" id="pop_cont_text"></div>
        <!--bottom:operate->button-->
        <div class="btm_btn">
            <input type="button" value="确认" class="input_btn trueBtn"/>
            <input type="button" value="取消" class="input_btn falseBtn"/>
        </div>
    </div>
</section>

@yield('content')

<script src="{{config('app.static')}}/js/jquery.js"></script>
<script src="{{config('app.static')}}/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="{{config('app.static')}}/js/admin.js"></script>

@yield('footer')