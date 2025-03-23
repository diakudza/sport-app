<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use App\Models\Training;
use App\Models\TrainingType;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class TrainingScreen extends Screen
{
    public $name = 'Набор тренировок';

    public function query(): iterable
    {
        return [
            'trainings' => Training::all()
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
                TD::make('name', 'Название'),
                TD::make('', 'Тип')->render(fn(Training $training)=>$training->type->name),
                TD::make('details_id', 'Тип_id'),
                TD::make('details_type', 'Тип_type'),
                TD::make('', 'Действия')->render(fn(Training $training) => Link::make('Редактировать')
                    ->route('platform.trainings.edit', $training))
            ])
        ];
    }
}
