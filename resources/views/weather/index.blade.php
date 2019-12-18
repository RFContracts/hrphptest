@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Погода в Брянске
            </div>
            @if(!empty($content))
                <div class="panel-body">
                    <span class="temp">{{$content['fact']['temp']}}<sup>°C</sup></span>
                    <img class="weather-icon" src="https://yastatic.net/weather/i/icons/blueye/color/svg/{{$content['fact']['icon']}}.svg">
                </div>
            @endif
        </div>
    </div>
</div>
@endsection