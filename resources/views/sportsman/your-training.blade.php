@extends('template.main')

@section('content')
    <table border="1" width="800">
        <thead>
        <th>Тип</th>
        <th>Сумма</th>
        <th>Дата добавления</th>
        <th></th>
        </thead>
        @foreach($trainings as $training)
            <tr style="height:100px;  background-color: @if ($training->approved) greenyellow @else indianred @endif">
                <td>{{$training->type?->name}}</td>
                <td>{{$training->points}}</td>
                <td>{{$training->created_at}}</td>
                <td>@if($training->attachments->count())
                        <a href="/storage/{{$training->attachments?->first()?->path}}" target="_blank">
                            <img width="100" src="/storage/{{$training->attachments?->first()?->path}}"/>
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
@endsection
