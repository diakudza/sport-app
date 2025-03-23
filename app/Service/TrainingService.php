<?php

namespace App\Service;

use App\Models\Training;
use App\Models\TrainingType;

class TrainingService
{
    public function saveTraining(array $data){

        $type = TrainingType::find($data['type']);

        if (!class_exists($type->model_class)) {
            throw new \Exception("Класс {$type->model_class} не найден.");
        }
//        dd($data['training']);
        $model = new $type->model_class();
        $model->fill($data['training'])->save();

        $training = new Training();
        $training->training_type_id = $type->id;
        $training->user_id = $data['user_id'];
        $training->trainable()->associate($model);
        $training->save();
        $training->calculatePoints();
        if(isset($data['attachment'])){
//dd($data['attachment']);

                foreach ($data['attachment'] as $file) {
                    $training->attachments()->attach($file); // Прикрепляем каждый файл
                }

//            $training->attachments()->attach($data['attachment']);
        }
    }
}
