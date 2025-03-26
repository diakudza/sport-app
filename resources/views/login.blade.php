@extends('template.main')

@section('content')

    <div class="bg-gray-100 flex items-center justify-center h-screen">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-bold mb-4">Вход в систему</h2>
            <form action="{{route('login.action')}}" method="post">
                @csrf
                <input type="email" placeholder="Логин" class="w-full p-2 border rounded mb-3" name="email">
                <input type="password" placeholder="Пароль" class="w-full p-2 border rounded mb-3" name="password">
                <button class="w-full bg-blue-600 text-white p-2 rounded">Войти</button>
            </form>
        </div>
    </div>
@endsection
