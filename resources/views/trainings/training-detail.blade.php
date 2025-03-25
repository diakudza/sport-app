@extends('template.main')

@section('content')
    <div class="flex-lg-row justify-content-between">
        {{$training->type->name}}
        @php
            $params = json_decode($training->trainable, true)
        @endphp
        @if($params)
            @foreach($params as $key=> $param)
                <p><b>{{$key}}:</b> {{$param}}</p>
            @endforeach
        @endif
{{--        <div>--}}
{{--            <h3 class="text-2xl font-bold mb-4">{{$event->title}}</h3>--}}
{{--            <div class="t">{!! $event->description !!}</div>--}}
{{--        </div>--}}

    </div>
@endsection
