<?php

namespace App\Service;

use App\Models\Training;
use App\Models\TrainingType;
use Orchid\Attachment\Models\Attachment;


class TrainingService
{
    public function saveTraining(array $data)
    {

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

        if (isset($data['attachment'])) {
            foreach ($data['attachment'] as $file) {

                $path = $file->store('training_attachments', 'public');
                $attachment = Attachment::create([
                    'name' => $file->hashName(), 'original_name' => $file->getClientOriginalName(),
                    'file_path' => $path, 'size' => $file->getSize(), 'mime' => $file->getClientMimeType(),
                    'path' => $path, 'extension' => $file->getClientMimeType()
                ]);

                $training->attachments()->attach($attachment->id);
            }
        }
    }
}
