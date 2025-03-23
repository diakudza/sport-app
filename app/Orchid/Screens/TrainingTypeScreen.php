<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use App\Models\TrainingType;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class TrainingTypeScreen extends Screen
{
    public $name = 'Типы тренировок';

    public function query(): iterable
    {
        return [
            'training_types' => TrainingType::all()
        ];
    }

    public function commandBar(): iterable
    {
        return [
//            Link::make('Создать')->route('platform.training-type.create')
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::table('training_types', [
                TD::make('name', 'Название'),
                TD::make('model_class', 'Класс модели'),
//                TD::make('', 'Действия')->render(fn(TrainingType $type) => Link::make('Редактировать')
//                    ->route('platform.training-type.edit', $type))
            ])
        ];
    }
}
