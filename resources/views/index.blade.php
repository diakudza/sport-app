@extends('template.main')

@section('content')


    @include('trainings.table')
    <hr>
    @include('trainings.ratings')

@endsection
