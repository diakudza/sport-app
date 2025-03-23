<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class TrainingStep extends Model
{
    use HasFactory;
    use AsSource;

    protected $fillable = ['step_count'];

    public function training()
    {
        return $this->morphOne(Training::class, 'trainable');
    }

    public function calculate()
    {
        return $this->step_count / 10000;
    }
}
