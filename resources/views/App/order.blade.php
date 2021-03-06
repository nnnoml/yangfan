@extends('frozenui')
@section('content')
    <section class="ui-container" style="padding-bottom:80px;">
        <section id="form">

            <ul class="ui-row ui-whitespace">
                <li class="ui-col ui-col-100">
                    <img style="width:100%" src="{{asset('/')}}{{$data->p_id}}"/>
                </li>
                <li class="ui-col ui-col-100 ui-border-radius">【{{$data->name}}】{{$data->desc}}</li>
                <li class="ui-col ui-col-100">&nbsp;</li>
            </ul>

            <div class="ui-form ui-border-t">
                <div class="ui-form-item ui-form-item-show ui-border-b">
                    <label for="#">名 称：</label>
                    <input readonly type="text" value="{{$data->name}}">
                </div>

                <div class="ui-form-item ui-form-item-show ui-border-b">
                    <label for="#">营业时间：</label>
                    <input readonly type="text" value="@if($data->start_time){{$data->start_time}} - {{$data->end_time}}@else 全天@endif">
                </div>

                <div class="ui-form-item ui-form-item-show ui-border-b">
                    <label for="#">单价：</label>
                    <input readonly type="text" value="{{$data->price/100}} 元/份">
                </div>

                <div class="ui-form-item ui-form-item-show ui-border-b">
                    <label for="#">剩余份数：</label>
                    <input readonly type="text" value="@if($data->max_num!=-1){{$data->max_num}}@else不限 @endif">
                </div>

                <div class="ui-form-item ui-border-b">
                    <label>购买份数：</label>
                    <input type="tel" maxlength="3" autocomplete="off"  name="order_num" value="1" placeholder="请输入想购买的份数"/>
                    <a href="javascript:;" onClick="cls(this)" class="ui-icon-close"></a>

                    {{--<div class="ui-select">--}}
                        {{--<select name="order_num">--}}
                            {{--<option value='0'>请选择份数</option>--}}
                            {{--<option value='1'>1份</option>--}}
                            {{--<option value='2'>2份</option>--}}
                            {{--<option value='3'>3份</option>--}}
                            {{--<option value='4'>4份</option>--}}
                            {{--<option value='5'>5份</option>--}}
                            {{--<option value='6'>6份</option>--}}
                            {{--<option value='7'>7份</option>--}}
                            {{--<option value='8'>8份</option>--}}
                            {{--<option value='9'>9份</option>--}}
                        {{--</select>--}}
                    {{--</div>--}}
                </div>

                <div class="ui-form-item ui-border-b">
                    <label>机器编号：</label>
                    <input type="text" name="machine_num" value="" placeholder="请输入机器编号"/>
                    <a href="javascript:;" onClick="cls(this)" class="ui-icon-close"></a>
                </div>
            </div>

        </section>

        <div class="ui-btn-wrap">
            <button id="submit" class="ui-btn-lg ui-btn-primary">确定</button>
        </div>

    </section>


@endsection

@section('footer')
    <script>
        $("#submit").click(function () {
            var order_num = parseInt($("input[name = 'order_num']").val());
            var machine_num = $("input[name='machine_num']").val();
            var el;
            if (order_num == 0 || isNaN(order_num)) {
                var dia = $.dialog({
                    title: '请选择份数',
                    button: ["确认"]
                });
            }
            else if (machine_num.length <= 0) {
                var dia = $.dialog({
                    title: '请填写机器编号',
                    button: ["确认"]
                });
            }
            else {
                $.ajax({
                    url: '{{asset('/')}}order',
                    type: "post",
                    data: "id={{$data->id}}&order_num="+order_num+"&machine_num="+machine_num+"&qr={{$qr}}&_token={{csrf_token()}}",
                    dataType: "json",
                    beforeSend: function () {
                        el = $.loading({content:'加载中...'});
                    },
                    success: function (result) {
                        if (result) {
                            //-------------------------------------------------------------------
                            function onBridgeReady(){
                                WeixinJSBridge.invoke(
                                        'getBrandWCPayRequest',result ,
                                        function(res){
                                            if(res.err_msg == "get_brand_wcpay_request:ok" ) {
                                                el.loading("hide");
                                                window.location.href="{{asset('/')}}user";
                                            }     // 使用以上方式判断前端返回,微信团队郑重提示：res.err_msg将在用户支付成功后返回    ok，但并不保证它绝对可靠。
                                        }
                                );
                            }
                            if (typeof WeixinJSBridge == "undefined"){
                                if( document.addEventListener ){
                                    document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
                                }else if (document.attachEvent){
                                    document.attachEvent('WeixinJSBridgeReady', onBridgeReady);
                                    document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
                                }
                            }else{
                                onBridgeReady();
                            }
                            //-------------------------------------------------------------------

                        }
                        else {
                            var dia = $.dialog({
                                title: '预定失败,库存不足',
                                button: ["确认"]
                            });
                        }
                    }
                })
            }
        })
    </script>
@endsection

