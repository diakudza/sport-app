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
        <br>
        <br>
        <div id="type-container"></div>
        <br>
        <input type="file" name="attachment[]" multiple id="">
        <button type="submit">Добавить</button>
    </form>

    <script>
        document.getElementById('type-selector').addEventListener('change', function () {
            const selectedTemplate = this.value;
            const container = document.getElementById('type-container');

            container.innerHTML = '';

            // Включаем соответствующий шаблон
            //Тут нужно потом поменять цифры на что-то связанное
            if (selectedTemplate === '1') {
                container.innerHTML = `@include('trainings.bike')`;
            } else if (selectedTemplate === '2') {
                container.innerHTML = `@include('trainings.yoga')`;
            } else if (selectedTemplate === '3') {
                container.innerHTML = `@include('trainings.run')`;
            } else if (selectedTemplate === '4') {
                container.innerHTML = `@include('trainings.strong')`;
            } else if (selectedTemplate === '5') {
                container.innerHTML = `@include('trainings.group')`;
            } else if (selectedTemplate === '6') {
                container.innerHTML = `@include('trainings.combat')`;
            } else if (selectedTemplate === '7') {
                container.innerHTML = `@include('trainings.step')`;
            }
        });
    </script>
@endsection
