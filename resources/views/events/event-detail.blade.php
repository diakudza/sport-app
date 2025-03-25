@extends('template.main')

@section('content')
    <div class="flex-lg-row justify-content-between">
        <div>

            <img src="{{$event->attachments()->first()->url()}}"/>
        </div>
        <div>
            <h3 class="text-2xl font-bold mb-4">{{$event->title}}</h3>
            <div class="t">{!! $event->description !!}</div>
        </div>

    </div>
@endsection
