@extends('template.main')

@section('title', 'Список событий')

@section('content')
    <div class="mx-auto d-flex flex-column">

        <h1 class="mt-2 text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl">Список
            событий</h1>

        <table class="mt-10 w-auto bg-white shadow-lg rounded-lg overflow-hidden">
            <thead class="bg-blue-600 text-white">
            <th class="p-2"></th>
            <th class="p-2">Название</th>
            <th class="p-2">Описание</th>
            <th class="p-2">Период</th>

            </thead>
            <tbody>
            @foreach($events as $event)
                <tr class="border-b cursor-pointer"
                    onclick="window.location.href = '{{ route('event.detail', $event->id) }}'">
                    <td class="p-2 ">
                        <img width="100" src="{{$event->attachments?->first()?->url()}}"/>
                    </td>
                    <td class="p-2">{{$event->name}}</td>
                    <td class="p-2 ">{{$event->short_description}}</td>
                    <td class="p-2 ">{{$event->date_start}} - {{$event->date_end}}</td>


                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

@endsection
