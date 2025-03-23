<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class TrainingBike extends Model
{
    use HasFactory;
    use AsSource;

    protected $fillable = ['distance', 'speed', 'duration', 'pulse'];

    public function training()
    {
        return $this->morphOne(\App\Models\Training::class, 'trainable');
    }

    public function calculate(): int
    {
        //4 балла за каждые 10 км
        if($this->distance){
            $points = (int)( $this->distance / 10 ) * 4 ;
        }

        return (int) $points ?? 0;
    }

}
