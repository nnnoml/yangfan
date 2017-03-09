@extends('frozenui')
@section('content')
    <section class="ui-container" style="padding-bottom:80px;">

        <section id="list">
        <ul class="ui-list ui-list-pure ui-border-tb">

                <table class="ui-table ui-border-tb">
                    <thead>
                    @if($flag=='cash')
                        <tr><th>NO.</th><th>入账金额</th><th>入账时间</th></tr>
                    @elseif($flag=='withdraw')
                        <tr><th>NO.</th><th>提现金额</th><th>提现时间</th><th>状态</th></tr>
                    @endif
                    </thead>
                    <tbody>
                    @foreach ($detail as $key=>$rs)
                    <tr title="{{$rs->order_id}}">
                        <td>{{$key+1}}</td>
                        <td>{{$rs->price/100}}元</td>
                        <td>{{$rs->created_at}}</td>
                        <td>
                            @if($rs->status==0)审核中
                            @elseif($rs->status==1)已提现
                            @elseif($rs->status==2)已驳回
                            @else -
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

        </ul>
        </section>


    </section>

@endsection
