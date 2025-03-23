<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Screen\AsMultiSource;

class TrainingType extends Model
{
    use HasFactory;
    use AsMultiSource;

    protected $fillable = ['name', 'model_class'];

    public function trainings(): HasMany
    {
        return $this->hasMany(Training::class);
    }
}
