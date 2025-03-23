<table class="table table-bordered">
    @foreach($trainings as $training)
        <tr >
            <td>{{$training->user?->name}}</td><td>{{$training->type?->name}}</td><td>{{$training->points}}</td>
        </tr>
    @endforeach
</table>
