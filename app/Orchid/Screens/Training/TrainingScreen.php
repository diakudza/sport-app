<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Training;

use App\Models\Training;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class TrainingScreen extends Screen
{
    public $name = 'Тренировоки пользователей';

    public function query(): iterable
    {
        return [
            'trainings' => Training::paginate(20)
        ];
    }

    public function commandBar(): iterable
    {
        return [
            Link::make('Создать')->route('platform.trainings.create')
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::table('trainings', [
                TD::make('Пользователь')->render(fn(Training $training)=>$training->user->name),
                TD::make('', 'Тип')->render(fn(Training $training)=>$training->type->name),
                TD::make('points', 'Очков'),
                TD::make('created_at', 'Дата'),
                TD::make('approved', 'Подтверждена'),
                TD::make('', 'Действия')->render(fn(Training $training) => Link::make('Редактировать')
                    ->route('platform.trainings.edit', $training))
            ])
        ];
    }
}
