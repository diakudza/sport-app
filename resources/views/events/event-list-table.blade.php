<h3 class="text-2xl font-bold mb-4">Список событий</h3>
<table class="w-auto bg-white shadow-lg rounded-lg overflow-hidden">
    <thead class="bg-blue-600 text-white">
    <th class="p-2">Название</th>
    <th class="p-2">Описание</th>
    <th class="p-2">Период</th>
    </thead>
    <tbody>
    @foreach($events as $event)
        <tr class="border-b">
            <td class="p-2">{{$event->name}}</td>
            <td class="p-2 ">{{$event->short_description}}</td>
            <td class="p-2 ">{{$event->date_start}} - {{$event->date_end}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
