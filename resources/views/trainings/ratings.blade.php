<h3 class="text-2xl font-bold mb-4">Рейтиг</h3>
<table class="w-auto bg-white shadow-lg rounded-lg overflow-hidden">
    <thead class="bg-blue-600 text-white">
    <th class="p-2">Имя</th>
    <th class="p-2">Сумма</th>
    </thead>
    <tbody>
    @foreach($ratings as $rating)
        <tr class="border-b">
            <td class="p-2">{{$rating->user?->name}}</td>
            <td class="p-2 ">{{$rating->total_points}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
