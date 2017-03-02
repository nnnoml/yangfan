@extends('frozenui')
@section('content')
    <section class="ui-container">

        <section id="slider">
            <div class="ui-slider">
                <ul class="ui-slider-content"
                    style="width: 300%; transition-property: transform; transition-timing-function: cubic-bezier(0.1, 0.57, 0.1, 1); transition-duration: 0ms; transform: translate(0px, 0px) translateZ(0px);">
                    <li class="current"><span style="background-image:url(http://placeholder.qiniudn.com/640x200)"></span></li>
                    <li class=""><span style="background-image:url(http://placeholder.qiniudn.com/640x200)"></span></li>
                    <li class=""><span style="background-image:url(http://placeholder.qiniudn.com/640x200)"></span></li>
                </ul>
                <ul class="ui-slider-indicators">
                    <li class="current">1</li>
                    <li class="">2</li>
                    <li class="">3</li>
                </ul>
            </div>
        </section>

        <ul class="ui-list ui-list-one ui-list-link ui-border-tb ui-list-active">
            @foreach ($shop_list as $rs)
            <li class="ui-border-t">
                <div class="ui-list-info" onclick="window.location.href='{{asset('/')}}dinner/{{$rs->qr_id}}'">
                    <h4 class="ui-nowrap">{{$rs->name}}</h4>
                    <div class="ui-txt-info">选择</div>
                </div>
            </li>
            @endforeach
        </ul>

    </section>
@endsection

@section('footer')
    <script class="demo-script">
        (function () {
            var slider = new fz.Scroll('.ui-slider', {
                role: 'slider',
                indicator: true,
                autoplay: true,
                interval: 3000
            });
        })();
    </script>
@endsection