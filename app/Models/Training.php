<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;

class Training extends Model
{
    use HasFactory;
    use AsSource;
    use Attachable;

    protected $fillable = ['user_id', 'training_type_id', 'trainable_id', 'trainable_type'];

    public function type()
    {
        return $this->belongsTo(TrainingType::class, 'training_type_id');
    }

    public function trainable()
    {
        return $this->morphTo();
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function calculatePoints()
    {
        if ($this->trainable) {
            $this->points = $this->trainable->speed * $this->trainable->distance * $this->trainable->duration;
            $this->save();
        }
    }
}
