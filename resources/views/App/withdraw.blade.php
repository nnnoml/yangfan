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
                <div class="ui-form-item ui-border-b">
                    <label>
                        提现金额
                    </label>
                <input type="text" id="num" placeholder="请填写提现金额,单位元">
                    <a href="#" class="ui-icon-close">
                    </a>
                </div>
                <button onClick="window.location.href='{{asset('/account/detail/withdraw')}}'" class="ui-btn-lg">提现明细</button>
                <button id="submit" class="ui-btn-primary ui-btn-lg">提现</button>
            </div>
        </section>

    </section>

@endsection
@section('footer')
    <script>
        $("#submit").click(function () {
            var num = parseInt($("#num").val())
            if (num == 0 || isNaN(num)) {
                var dia = $.dialog({
                    title: '请填写提现金额',
                    button: ["确认"]
                });
            }
            else if(num > {{$user_info->account_cash/100}}){
                var dia = $.dialog({
                    title: '所填金额大于账户余额',
                    button: ["确认"]
                });
            }
            else{
                /*--------------------------------------------------------------------------------------*/
                $.ajax({
                    url: '{{asset('/')}}withdraw',
                    type: "post",
                    data: "num="+num+"&_token={{csrf_token()}}",
                    dataType: "json",
                    beforeSend: function () {
                        el = $.loading({content:'加载中...'});
                    },
                    success: function (result) {
                        if (result.no==0) {
                            el.loading("hide");
                            window.location.href="{{asset('/account/detail/withdraw')}}";
                        }
                        else {
                            el.loading("hide");
                            var dia = $.dialog({
                                title: result.msg,
                                button: ["确认"]
                            });
                        }
                    }
                })
                /*--------------------------------------------------------------------------------------*/
            }
        });


    </script>
@endsection