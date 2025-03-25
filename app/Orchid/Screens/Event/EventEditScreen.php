<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Event;

use App\Repository\EventRepository;
use App\Models\{Event, User};
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class EventEditScreen extends Screen
{
    public ?Event $event = null;

    public function __construct(protected EventRepository $eventRepository)
    {
    }

    public function query(Event $event): iterable
    {
        $this->event = $event;

        return ['event' => $event];
    }

    public function name(): ?string
    {
        return $this->event->exists ? 'Редактирование' .
            $this->event->name : 'Создание';
    }

    public function commandBar(): iterable
    {
        return [
            Button::make('Сохранить')->method('save')
        ];
    }

    public function layout(): iterable
    {


        $fields = [
            Input::make('event.name')->title('Название'),
            Input::make('event.short_description')->title('Короткое описание')->required(),
            Quill::make('event.description')->title('Описание'),
            Group::make([
                DateTimer::make('event.date_start')->format('Y-m-d')->title('Дата Старта'),
                DateTimer::make('event.date_end')->format('Y-m-d')->title('Дата окончания'),
            ]),
            Upload::make('event.attachment')
                ->groups('events')
                ->maxFiles(1)
                ->title('Изображение'),
            Relation::make('event.users')->title('Участники')->multiple()
                ->fromModel(User::class, 'name'),
            Switcher::make('event.active')->sendTrueOrFalse()->title('Активна'),
        ];

//        if ($this->event->attachments->count()) {
//            $fields = array_merge($fields, [
//                Link::make('Прикрепленное изображение')
//                    ->href('/storage/' . $this->event->attachments()->first()?->path)]);
//        }

        return [
            Layout::rows($fields)
        ];
    }

    public function save(Event $event, Request $request)
    {
        $data = $request->validate([
            'event.name' => 'required|string',
            'event.short_description' => 'required|string',
            'event.description' => 'string',
            'event.date_start' => 'string',
            'event.date_end' => 'string',
            'event.active' => 'boolean',
            'event.attachment' => 'sometimes|array',
            'event.users' => 'sometimes|array',
        ]);

        $this->eventRepository->saveFromPlatform($event, $data['event']);
//        if ($event->exists) {
//            $event->active = true;
//            $event->save();
//
//        }
        Toast::info('Тип тренировки сохранен!');
        return redirect()->route('platform.events');
    }
}
