<h2 class="text-2xl font-bold mb-4">Таблица тренировок</h2>
@foreach($eventTrainings as $key=>$trainings)
    <h3 class="text-2xl font-bold mb-4">{{$key}}</h3>
    <div class="flex">
        <div class="mr-10">
            <table class="w-full bg-white shadow-lg rounded-lg overflow-hidden">
                <thead class="bg-blue-600 text-white">
                <th class="p-2">Имя</th>
                <th class="p-2">Тип тренировки</th>
                <th class="p-2">Очки</th>
                </thead>
                <tbody>
                @foreach($trainings as $training)
                    <tr class="border-b">
                        <td class="p-2 ">{{$training->user?->name}}</td>
                        <td class="p-2 text-center">{{$training->type?->name}}</td>
                        <td class="p-2 text-center">{{$training->points}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div>
            @include('trainings.ratings', ['ratings' => $ratings->get($key)])
        </div>
    </div>

@endforeach

