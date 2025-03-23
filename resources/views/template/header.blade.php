@auth()
    <a href="{{route('home')}}">Главная</a>|
    <a href="{{route('sportsmen.training.page')}}">Добавить тренировку</a>|
    <a href="{{route('sportsmen.trainings')}}">Записанные тренировки </a>|
    <a href="{{route('logout.action')}}">{{auth()->user()->email}}</a>
@endauth
@guest()
    <a href="{{route('login.page')}}">Login</a>
@endguest
<br>
<br>
