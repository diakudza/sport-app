<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Toast;
use App\Models\{Training};
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class TrainingEditScreen extends Screen
{
    public $name = 'Редактирование тренировки';
    public ?Training $training = null;

    public function query(Training $training): iterable
    {
        $this->training = $training;

        return ['training' => $training];
    }

    public function name(): ?string
    {
        return $this->training->exists ? 'Редактирование' .
            $this->training->name : 'Создание';
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
            Input::make('training.user.name')->title('Название'),
            Input::make('training.points')->title('Очки'),
            Input::make('training.created_at')->title('Дата'),
            Input::make('training.type.name')->title('Тип'),
        ];

        if ($this->training->attachments->count()) {
            $fields = array_merge($fields, [
                Link::make('Прикрепленное изображение')
                    ->href('/storage/' . $this->training->attachments()->first()?->path)]);
        }

        return [
            Layout::rows($fields)
        ];
    }

    public function save(Training $training, Request $request)
    {
        if ($training->exists) {
            $training->approved = true;
            $training->save();
            Toast::info('Тип тренировки сохранен!');
            return redirect()->route('platform.trainings');
        }
    }
}
