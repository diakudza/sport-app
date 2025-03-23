<table border="1">
    <thead>
    <th>Имя</th>
    <th>Сумма</th>
    </thead>
    @foreach($ratings as $rating)
        <tr>
            <td>{{$rating->user?->name}}</td>
            <td>{{$rating->total_points}}</td>
        </tr>
    @endforeach
</table>
