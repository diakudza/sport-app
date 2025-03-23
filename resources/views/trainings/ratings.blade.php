<table>
    @foreach($ratings as $rating)
        <tr>
            <td>{{$rating->user?->name}}</td><td>{{$rating->total_points}}</td>
        </tr>
    @endforeach
</table>
