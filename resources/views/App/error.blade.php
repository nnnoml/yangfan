@extends('frozenui')
@section('content')
    <section class="ui-container">

        <section class="ui-notice" style="height:70%">
            <i></i>
            <p>抱歉，该店目前暂停营业<br />{{$notice}}</p>
        </section>

    </section>
@endsection
