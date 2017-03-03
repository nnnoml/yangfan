@extends('frozenui')
@section('content')
    <section class="ui-container">

        <ul class="ui-row ui-whitespace" style="padding-bottom:80px;">
            @foreach ($dinner_list as $rs)
                <li class="ui-col ui-col-100">
                    <a href="{{asset('/')}}order/{{$rs->id}}?qr={{$qr_id}}">
                    <img style="width:100%" src="{{asset('property/')}}/{{$rs->p_id}}.png"/>
                    </a>
                </li>
                <li class="ui-col ui-col-100 ui-border-radius">【{{$rs->name}}】{{$rs->desc}}</li>
                <li class="ui-col ui-col-100">&nbsp;</li>
            @endforeach
        </ul>
    </section>


@endsection
