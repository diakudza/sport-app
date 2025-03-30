<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;

class Event extends Model
{
    use HasFactory;
    use AsSource;
    use Attachable;

    protected $fillable = ['name', 'short_description','description', 'date_start', 'date_end', 'active'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'event_users');
    }

    public function training_types(): BelongsToMany
    {
        return $this->belongsToMany(TrainingType::class, 'event_training_types');
    }
}
