<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Event;

use App\Models\Event;
use App\Repository\EventRepository;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class EventScreen extends Screen
{
    public $name = "Спортивные события";

    public function __construct(protected EventRepository $eventRepository)
    {
    }

    public function query(): iterable
    {
        return [
            'events' => Event::query()->with(['attachment'])->paginate(20)
        ];
    }

    public function commandBar(): iterable
    {
        return [
            Link::make('Создать')->route('platform.events.create')
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::table('events', [
                TD::make('name'),
                TD::make('short_description', 'Описание'),
                TD::make('', 'Период')->render(fn(Event $event) => $event->date_start . "-" . $event->date_end),
                TD::make('active', 'Активная'),
                TD::make('created_at', 'Дата'),
                TD::make('', 'Действия')->render(fn(Event $event) => Link::make('Редактировать')
                    ->route('platform.events.edit', $event))
            ])
        ];
    }
}
