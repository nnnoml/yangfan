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

        <ul class="ui-grid-halve">
        <li>
            <div class="ui-grid-halve-img">
                <span style="background-image:url(http://placeholder.qiniudn.com/290x160)" class="ui-tag-hot"></span>
            </div>
        </li>
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