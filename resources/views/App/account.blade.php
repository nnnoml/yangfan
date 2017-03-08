@extends('frozenui')
@section('content')
    <section class="ui-container">

        <section class="ui-notice" style=" height:80%">
            <div class="ui-avatar" style="width:100px;height:100px; margin-bottom:20px;">
                <span style="background-image:url({{$user_info->avatar}})"></span>
            </div>
            <p style="padding-bottom:20px;">{{$user_info->nick}}</p>

            <ul class="ui-tiled">
                <li><div>累计金额</div><i>{{$user_info->account_sum/100}}元</i></li>
                <li><div>账户余额</div><i>{{$user_info->account_cash/100}}元</i></li>
                <li><div>完成单数</div><i>{{$user_info->account_num}}单</i></li>
            </ul>

            <div class="ui-notice-btn">

                <button onClick="window.location.href='{{asset('/account/detail/cash')}}'" class="ui-btn-lg">入账明细</button>
                <button onClick="window.location.href='{{asset('/account/detail/withdraw')}}'" class="ui-btn-lg">提现明细</button>
                <button onClick="window.location.href='{{asset('/withdraw')}}'" class="ui-btn-primary ui-btn-lg">申请提现</button>
            </div>
        </section>

    </section>

@endsection
