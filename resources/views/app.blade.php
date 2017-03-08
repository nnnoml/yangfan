<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>{{config('app.title')}}</title>
    <meta name="author" content="Charis"/>
    <link rel="stylesheet" type="text/css" href="{{asset('static/css/style.css')}}"/>
    <!--[if lt IE 9]>
    <script src="js/html5.js"></script>
    <![endif]-->

</head>

<body>
<!--header-->
<header>
    <h1><img src="{{asset('static/images/admin_logo.png')}}"/></h1>
    <ul class="rt_nav">
        <li><a href="{{URL::to('admin')}}" class="website_icon">系统首页</a></li>
        {{--<li><a href="#" class="admin_icon">DeathGhost</a></li>--}}
        <li><a href="{{URL::to('admin/auth')}}" class="set_icon">用户设置</a></li>
        <li><a href="{{URL::to('admin/loginOut')}}" class="quit_icon">安全退出</a></li>
    </ul>
</header>

<!--aside nav-->
<aside class="lt_aside_nav content mCustomScrollbar">
    <ul id="left_nav">
        <li>
            <dl>
                <dt onClick="window.location.href='{{URL::to('admin/conf')}}'">系统设置</dt>
                {{--<dd><a href="{{URL::to('admin/conf')}}" @if ($nav == '1-1') class="active" @endif >活动配置</a></dd>--}}
                {{--<dd><a href="{{URL::to('Roll/config')}}" @if ($nav == '1-2') class="active" @endif >普通奖品池</a></dd>--}}
                {{--<dd><a href="{{URL::to('Roll/dajiang')}}"  @if ($nav == '1-3') class="active" @endif >行列大奖</a></dd>--}}
                {{--<dd><a href="{{URL::to('Roll/log')}}" @if ($nav == '1-4') class="active" @endif >日志列表</a></dd>--}}
                {{--<dd><a href="{{URL::to('Roll/prizelog')}}" @if ($nav == '1-5') class="active" @endif >获奖日志</a></dd>--}}
            </dl>
        </li>
        <li>
            <dl>
                <dt>店铺管理</dt>
                <dd><a href="{{URL::to('admin/sellshop')}}" @if ($nav == '2-1') class="active" @endif >餐馆管理</a></dd>
                <dd><a href="{{URL::to('admin/buyshop')}}" @if ($nav == '2-2') class="active" @endif >娱乐场所管理</a></dd>
                <dd><a href="{{URL::to('admin/relation')}}" @if ($nav == '2-3') class="active" @endif >对应关系</a></dd>
            </dl>
        </li>

        <li>
            <dl>
                <dt onClick="window.location.href='{{URL::to('admin/user')}}'">用户管理</dt>
            </dl>
        </li>

        <li>
            <dl>
                <dt onClick="window.location.href='{{URL::to('admin/order')}}'">订单日志</dt>
            </dl>
        </li>

        <li>
            <dl>
                <dt onClick="window.location.href='{{URL::to('admin/cashflow')}}'">分账流水</dt>
            </dl>
        </li>

        <li>
            <dl>
                <dt onClick="window.location.href='{{URL::to('admin/withdraw')}}'">提现日志</dt>
            </dl>
        </li>

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

<script src="{{asset('static/js/jquery.js')}}"></script>
<script src="{{asset('static/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{asset('static/js/admin.js')}}"></script>

<link rel="stylesheet" type="text/css" href="{{asset('static/timepicker/css/jquery-ui.css')}}" />
<script src="{{asset('static/timepicker/js/jquery-ui.js')}}"></script>
<script src="{{asset('static/timepicker/js/jquery-ui-slide.min.js')}}"></script>
<script src="{{asset('static/timepicker/js/jquery-ui-timepicker-addon.js')}}"></script>

@yield('footer')