@extends('template.main')

@section('title', 'Добавление тренировки')

@section('content')
    <div class="bg-gray-100 flex items-center justify-center h-screen">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-bold mb-4">Добавление тренировки</h2>
            <form action="{{route('sportsmen.training.add')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" class="w-full p-2 border rounded mb-3"
                       value="{{auth()->user()?->id}}">
                <select name="event_id" id="event-selector" class="w-full p-2 border rounded mb-3">
                    <option>Выберите доступное вам соревнования</option>
                    @foreach($events as $event)
                        <option value="{{$event->id}}">{{$event->name}}</option>
                    @endforeach
                </select>
                <select name="type" id="type-selector" class="w-full p-2 border rounded mb-3">
                    <option>Выберите тип тренировки</option>
                </select>

                <div id="type-container"></div>

                <input class="w-full p-2 border rounded mb-3" type="file" name="attachment[]" multiple id="">
                <button class="w-full bg-blue-600 text-white p-2 rounded" type="submit">Добавить</button>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('event-selector').addEventListener('change', function () {
            const typeSelect = document.getElementById('type-selector');
            const competitionId = this.value;
            const container = document.getElementById('type-container');
            if (competitionId) {
                fetch(`{{ route('trainingTypes.event') }}?event_id=${competitionId}`)
                    .then(response => response.json())
                    .then(data => {
                        typeSelect.innerHTML = ''; // Очищаем второй селект
                        typeSelect.disabled = false;
                        container.innerHTML = '';
                        for (const key in data) {
                            const option = document.createElement('option');
                            option.value = key;
                            option.text = data[key];
                            typeSelect.appendChild(option);
                        }
                    })
                    .catch(error => {
                        alert('Ошибка при загрузке активностей.');
                        typeSelect.disabled = true;
                    });
            } else {
                typeSelect.innerHTML = '<option value="">Выберите активность</option>';
                typeSelect.disabled = true;
            }
        });
        document.getElementById('type-selector').addEventListener('change', function () {
            const selectedTemplate = this.value;
            const container = document.getElementById('type-container');

            container.innerHTML = '';

            // Включаем соответствующий шаблон
            //Тут нужно потом поменять цифры на что-то связанное
            if (selectedTemplate === 'bike') {
                container.innerHTML = `@include('trainings.parts.bike')`;
            } else if (selectedTemplate === 'yoga') {
                container.innerHTML = `@include('trainings.parts.yoga')`;
            } else if (selectedTemplate === 'run') {
                container.innerHTML = `@include('trainings.parts.run')`;
            } else if (selectedTemplate === 'strong') {
                container.innerHTML = `@include('trainings.parts.strong')`;
            } else if (selectedTemplate === 'group') {
                container.innerHTML = `@include('trainings.parts.group')`;
            } else if (selectedTemplate === 'combat') {
                container.innerHTML = `@include('trainings.parts.combat')`;
            } else if (selectedTemplate === 'step') {
                container.innerHTML = `@include('trainings.parts.step')`;
            }
        });
    </script>
@endsection
