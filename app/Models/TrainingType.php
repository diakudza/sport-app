<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class TrainingType extends Model
{
    use HasFactory;
    use AsSource;

    protected $fillable = ['name', 'model_class'];
}
