@extends('frozenui')
@section('content')
    <section class="ui-container">
        <section id="list">
        <ul class="ui-list ui-list-pure ui-border-tb">
            @foreach ($user_order_list as $key=>$rs)
            <li class="ui-border-t">
                <p><span>{{$key+1}}. {{$rs->g_name}} {{$rs->order_num}}份</span></p>
                <p>下单时间<span class="date"> {{$rs->created_at}}</span></p>
                <h4>订单总价：{{$rs->order_num}}*{{$rs->order_single_price/100}} = {{$rs->order_cash/100}} 元</h4>
                <h4>送达地址：{{$rs->bs_name}}-{{$rs->machine_num}}</h4>
                @if($rs->status==0)
                <button class="ui-btn ui-btn-danger">支付失败</button>
                @endif
            </li>
            @endforeach
        </ul>
        </section>

    </section>


@endsection
