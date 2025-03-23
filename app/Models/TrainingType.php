<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsMultiSource;
use Orchid\Screen\AsSource;

class TrainingType extends Model
{
    use HasFactory;
    use AsMultiSource;

    protected $fillable = ['name', 'model_class', 'formula'];

    public function trainings()
    {
        return $this->hasMany(Training::class);
    }
}
