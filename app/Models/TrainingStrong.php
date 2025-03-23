<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class TrainingStrong extends Model
{
    use HasFactory;
    use AsSource;

    protected $fillable = ['total_weight', 'duration'];

    public function training()
    {
        return $this->morphOne(\App\Models\Training::class, 'trainable');
    }
    public function calculate(): int
    {
        return 5;
    }
}
