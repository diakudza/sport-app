<table border="1" width="800">
    <thead>
        <th>Имя</th>
        <th>Тип тренировки</th>
        <th>Очки</th>
    </thead>
    @foreach($trainings as $training)
        <tr >
            <td>{{$training->user?->name}}</td><td>{{$training->type?->name}}</td><td>{{$training->points}}</td>
        </tr>
    @endforeach
</table>
