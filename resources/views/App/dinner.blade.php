@extends('frozenui')
@section('content')
    <section class="ui-container" style="padding-bottom:80px;">

        <ul class="ui-list ui-list-link ui-border-tb">
            @foreach ($dinner_list as $rs)
            <li class="ui-border-t">
                <div class="ui-list-img" onClick="window.location.href='{{asset('/')}}order/{{$rs->id}}?qr={{$qr_id}}'">
                    <span style="background-image:url({{asset('/')}}{{$rs->p_id}})"></span>
                </div>
                <div class="ui-list-info"  onClick="window.location.href='{{asset('/')}}order/{{$rs->id}}?qr={{$qr_id}}'">
                    <h4 class="ui-nowrap">【{{$rs->name}}】</h4>
                    <p class="ui-nowrap">{{$rs->desc}}</p>
                </div>
            </li>
            @endforeach
        </ul>

    </section>

@endsection
