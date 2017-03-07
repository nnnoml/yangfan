<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>{{env('TITLE','首页')}}</title>
    <link rel="stylesheet" href="{{asset('frozenui/css/frozen.css')}}">
</head>
<body>
<header class="ui-header ui-header-positive ui-border-b">
    <i class="ui-icon-return" onclick="history.back()"></i><h1>{{$title}}</h1>
</header>
@yield('content')

<footer class="ui-footer ui-footer-btn">
    <ul class="ui-tiled ui-border-t">
        <li data-href="{{asset('/')}}" class="ui-border-r"><i class="ui-icon-hall"></i><div>首页</div></li>
        <li data-href="{{asset('/')}}user"><div><i class="ui-icon-personal"></i>我的订单</div></li>
        @if($user_status)
        <li data-href="{{asset('/')}}account"><div><i class="ui-icon-set"></i>账户信息</div></li>
        @endif

    </ul>
</footer>



<script src="{{asset('frozenui/js/zepto.min.js')}}"></script>
<script src="{{asset('frozenui/js/frozen.js')}}"></script>
<script>
    $('.ui-tiled li').click(function(){
        if($(this).data('href')){
            location.href= $(this).data('href');
        }
    });
    function cls(thi) {
        $(thi).prev().val('');
    }
</script>
@yield('footer')
</body>
</html>