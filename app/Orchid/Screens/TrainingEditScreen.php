<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use Orchid\Support\Facades\Toast;
use App\Models\{Training, TrainingType};
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
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
        return $this->training->exists ?  'Редактирование'.
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
        return [
            Layout::rows([
                Relation::make('training.training_type_id')
                    ->title('Тип тренировки')
                    ->fromModel(TrainingType::class, 'name')
                    ->required(),
            ]),
//            Layout::rows([
//                Input::make('training.name')->title('Название'),
//                Input::make('training.details_type')->title('детали'),
//                Input::make('training.details_id')->title('детали_id'),
//
//                Relation::make('training.training_type_id')
//                    ->title('Тип_id')
//                    ->fromModel(TrainingType::class, 'name'),
//            ])
        ];
    }

    public function save(Request $request)
    {
        $type = TrainingType::find(request('training.training_type_id'));

        if (!class_exists($type->model_class)) {
            throw new \Exception("Класс {$type->model_class} не найден.");
        }

        $model = new $type->model_class();
        $model->fill(['distance'=> 10, 'duration'=>30, 'speed'=>1]);
        $model->save();

        $training = new Training();
        $training->training_type_id = $type->id;
        $training->user_id = 1;
        $training->trainable()->associate($model);
        $training->save();
        $training->calculatePoints();
        Toast::info('Тип тренировки сохранен!');
        return redirect()->route('platform.trainings');
    }
}
