@extends('template.main')

@section('content')
    <h3 class="text-2xl font-bold mb-4">Ваши тренировки</h3>
    <table class="w-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <thead class="bg-blue-600 text-white">
        <th class="p-2">id</th>
        <th class="p-2">Имя</th>
        <th class="p-2">Сумма</th>
        <th class="p-2">Дата добавления</th>
        <th class="p-2"></th>
        </thead>
        <tbody>
        @foreach($trainings as $training)
            <tr class="border-b">
                <td class="p-2"><a href="{{route('training.detail',$training->id )}}">{{$training->id}}</a></td>
                <td class="p-2">{{$training->type?->name}}</td>
                <td class="p-2 ">{{$training->points}}</td>
                <td class="p-2 ">{{$training->created_at}}</td>
                <td class="p-2 ">@if($training->attachments->count())
                        <a href="/storage/{{$training->attachments?->first()?->path}}" target="_blank">
                            <img width="100" src="/storage/{{$training->attachments?->first()?->path}}"/>
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
