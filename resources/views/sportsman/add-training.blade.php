@extends('template.main')

@section('content')
    <div class="bg-gray-100 flex items-center justify-center h-screen">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-bold mb-4">Добавление тренировки</h2>
            <form action="{{route('sportsmen.training.add')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" class="w-full p-2 border rounded mb-3"
                       value="{{auth()->user()?->id}}">
                <select name="event_id" class="w-full p-2 border rounded mb-3">
                    <option>Выберите доступное вам соревнования</option>
                    @foreach($events as $event)
                        <option value="{{$event->id}}">{{$event->name}}</option>
                    @endforeach
                </select>
                <select name="type" id="type-selector" class="w-full p-2 border rounded mb-3">
                    <option>Выберите тип тренировки</option>
                    @foreach($trainingTypes as $type)
                        <option value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach
                </select>

                <div id="type-container"></div>

                <input class="w-full p-2 border rounded mb-3" type="file" name="attachment[]" multiple id="">
                <button class="w-full bg-blue-600 text-white p-2 rounded" type="submit">Добавить</button>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('type-selector').addEventListener('change', function () {
            const selectedTemplate = this.value;
            const container = document.getElementById('type-container');

            container.innerHTML = '';

            // Включаем соответствующий шаблон
            //Тут нужно потом поменять цифры на что-то связанное
            if (selectedTemplate === '1') {
                container.innerHTML = `@include('trainings.parts.bike')`;
            } else if (selectedTemplate === '2') {
                container.innerHTML = `@include('trainings.parts.yoga')`;
            } else if (selectedTemplate === '3') {
                container.innerHTML = `@include('trainings.parts.run')`;
            } else if (selectedTemplate === '4') {
                container.innerHTML = `@include('trainings.parts.strong')`;
            } else if (selectedTemplate === '5') {
                container.innerHTML = `@include('trainings.parts.group')`;
            } else if (selectedTemplate === '6') {
                container.innerHTML = `@include('trainings.parts.combat')`;
            } else if (selectedTemplate === '7') {
                container.innerHTML = `@include('trainings.parts.step')`;
            }
        });
    </script>
@endsection
