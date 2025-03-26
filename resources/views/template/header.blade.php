<header class="bg-blue-900 text-white p-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold">Спортики</h1>
    <nav>

        <a href="{{route('home')}}" class="mr-4">Главная</a>
        <a href="{{route('event.page')}}" class="mr-10">События</a>

        @auth()
            <a href="{{route('sportsmen.training.page')}}" class="mr-4">Добавить тренировку</a>
            <a href="{{route('sportsmen.trainings')}}" class="mr-4">Записанные тренировки </a>
            <a href="{{route('logout.action')}}">Выход</a>
        @endauth
        @guest()
            <a href="{{route('login.page')}}">Вход</a>
        @endguest

    </nav>
</header>



