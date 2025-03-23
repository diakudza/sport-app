@extends('template.main')

@section('content')
    <form class="form-control" action="{{route('login.action')}}" method="post">
        @csrf
        <input type="email" name="email">
        <input type="password" name="password" >
        <button type="submit">логин</button>
    </form>

@endsection
