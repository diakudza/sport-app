@extends('template.main')

@section('content')
    <table class="table table-bordered">
        @foreach($trainings as $training)
            <tr style="height:100px;">
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
