<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    public function type()
    {
        return $this->belongsTo(TrainingType::class, 'training_type_id');
    }

    public function details()
    {
        return $this->morphTo();
    }

    public function getDetailsRelation()
    {
        return $this->hasOne($this->type->model_class, 'id', 'details_id');
    }
}
