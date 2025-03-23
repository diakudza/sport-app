<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class TrainingVelo extends Model
{
    use HasFactory;
    use AsSource;

    protected $fillable = ['distance', 'speed', 'duration'];

    public function training()
    {
        return $this->morphOne(\App\Models\Training::class, 'trainable');
    }
}
