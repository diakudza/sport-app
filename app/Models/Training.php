<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;

class Training extends Model
{
    use HasFactory;
    use AsSource;
    use Attachable;

    protected $fillable = ['user_id', 'training_type_id', 'trainable_id', 'trainable_type', 'approved', 'event_id'];

    public function type(): BelongsTo
    {
        return $this->belongsTo(TrainingType::class, 'training_type_id');
    }

    public function trainable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function calculatePoints(): void
    {
        if ($this->trainable) {
            $this->points = $this->trainable->calculate();
            $this->save();
        }
    }
}
