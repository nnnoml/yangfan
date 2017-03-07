@extends('frozenui')
@section('content')
    <section class="ui-container">

        <section id="list">
        <ul class="ui-list ui-list-pure ui-border-tb">

                <table class="ui-table ui-border-tb">
                    <thead>
                    @if($flag=='cash')
                        <tr><th>NO.</th><th>入账金额</th><th>入账时间</th></tr>
                    @elseif($flag=='withdraw')
                        <tr><th>NO.</th><th>提现金额</th><th>提现时间</th></tr>
                    @endif
                    </thead>
                    <tbody>
                    @foreach ($detail as $key=>$rs)
                    <tr title="{{$rs->order_id}}"><td>{{$key+1}}</td><td>{{$rs->price/100}}元</td><td>{{$rs->created_at}}</td></tr>
                    @endforeach
                    </tbody>
                </table>

        </ul>
        </section>


    </section>

@endsection
