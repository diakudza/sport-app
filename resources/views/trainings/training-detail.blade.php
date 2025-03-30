@php use Illuminate\Support\Arr; @endphp
@extends('template.main')

@section('content')
    @php
        $params = json_decode($training->trainable, true);
        $params = Arr::except($params,['id','created_at', 'updated_at']);
    @endphp
    <div class="flex justify-between">
        <div>
            <h3 class="text-2xl font-bold mb-4">{{$training->type->name}}</h3>

            <div class="flex-lg-row justify-content-between">
                @if($params)
                    @foreach($params as $key=> $param)
                        <p><b>{{__('custom.'.$key)}}: </b> {{$param}}</p>
                    @endforeach
                @endif

            </div>
        </div>
        <div>
            @if($training->attachments()->count())
                <img class="w-[48rem] max-w-none rounded-xl bg-gray-900 ring-1 shadow-xl ring-gray-400/10 sm:w-[57rem]"
                     src="/storage/{{$training->attachments()?->first()?->path}}"/>
            @endif
        </div>
    </div>

@endsection
