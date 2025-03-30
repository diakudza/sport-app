<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Training;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;
use App\Models\{Training};
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class TrainingEditScreen extends Screen
{
    public $name = 'Редактирование тренировки';
    public ?Training $training = null;
    public ?array $typeValues = [];

    public function query(Training $training): iterable
    {
        $this->training = $training->load(['attachment', 'trainable']);

        $this->typeValues = $training->getTypeFieldsWithValues()?->map(function ($item) {
            return [
                'key' => __('custom.'.$item['value']) ?? '', // Значение свойства
                'value' => $item['key'] ?? '', // Название свойства
            ];
        })->values()->toArray() ?? [];

        return ['training' => $training, 'typeValues' => $this->typeValues];
    }

    public function name(): ?string
    {
        return $this->training->exists ? 'Редактирование' .
            $this->training->name : 'Создание';
    }

    public function commandBar(): iterable
    {
        return [
            Button::make('Подтвердить')->method('approve')
        ];
    }

    public function layout(): iterable
    {
//dd($this);
        $fields = [
            Input::make('training.user.name')->title('Название'),
            Input::make('training.points')->title('Очки'),
            Input::make('training.created_at')->title('Дата'),
            Input::make('training.type.name')->title('Тип'),
            Matrix::make('typeValues')
                ->title('Дополнительные значения')
            ->columns(['Параметр'=>'key', 'Значение'=>'value'])
//            ->value('value')
            ,
        ];

        if ($this->training->attachments->count()) {
            $fields = array_merge($fields, [
                Link::make('Прикрепленное изображение')
                    ->href('/storage/' . $this->training->attachments()->first()?->path),
//                 Upload::make('training.attachment')
//                     ->maxFiles(1)
//                     ->title('ddd'),
            ]);


        }

        return [
            Layout::rows($fields)
        ];
    }

    public function approve(Training $training, Request $request)
    {
        if ($training->exists) {
            $training->approved = true;
            $training->save();
            Toast::info('Тип тренировки сохранен!');
            return redirect()->route('platform.trainings');
        }
    }
}
