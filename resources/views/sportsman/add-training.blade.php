@extends('template.main')

@section('content')
    <form action="{{route('sportsmen.training.add')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="user_id" value="{{auth()->user()?->id}}">
        <select name="type" id="type-selector">
            <option>Выберите тип тренировки</option>
            @foreach($trainingTypes as $type)
                <option value="{{$type->id}}">{{$type->name}}</option>
            @endforeach
        </select>
        <div id="type-container"></div>
        <input type="file" name="attachment[]" multiple id="">
        <button type="submit">Добавить</button>
    </form>

    <script>
        document.getElementById('type-selector').addEventListener('change', function () {
            const selectedTemplate = this.value;
            const container = document.getElementById('type-container');

            // Очищаем контейнер
            container.innerHTML = '';

            // Включаем соответствующий шаблон
            if (selectedTemplate === '1') {
                container.innerHTML = `@include('trainings.velo')`;
            } else if (selectedTemplate === '2') {
                container.innerHTML = `@include('trainings.yoga')`;
            }
        });
    </script>
@endsection
