@extends('template.main')

@section('title', 'Главная')

@section('content')
    <div class="flex justify-between">
        <div class="flex flex-col">
            @include('trainings.table')
        </div>

        <div class="flex flex-col ">
            @include('events.event-list-table')
        </div>
    </div>
@endsection
