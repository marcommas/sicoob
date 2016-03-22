@extends('painel.templates.index')

@section('content')

<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

    <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    </ol>

    <div class="carousel-inner" role="listbox" >
        <div class="item active">
            <img src="{{url('assets/img/inicial1.jpg')}}" >
        </div>
        <div class="item">
            <img src="{{url('assets/img/inicial2.jpg')}}" >
        </div>
    </div>
</div>

@endsection

