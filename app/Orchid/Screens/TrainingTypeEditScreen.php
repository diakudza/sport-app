<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use App\Models\TrainingType;
use Illuminate\Http\Request;
use Orchid\Alert\Toast;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class TrainingTypeEditScreen extends Screen
{
    public $name = 'Редактирование типа тренировки';
    public $trainingType;

    public function query(TrainingType $trainingType): iterable
    {
        return ['trainingType' => $trainingType];
    }

    public function commandBar(): iterable
    {
        return [
            Button::make('Сохранить')->method('save')
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('trainingType.name')->title('Название'),
                Input::make('trainingType.model_class')->title('Класс модели')
            ])
        ];
    }

    public function save(Request $request)
    {
        $data = $request->validate([
            'trainingType.name' => 'required|string',
            'trainingType.model_class' => 'required|string|unique:training_types,model_class'
        ]);

        $this->trainingType->fill($data['trainingType'])->save();
        Toast::info('Тип тренировки сохранен!');
        return redirect()->route('platform.training-types');
    }
}
