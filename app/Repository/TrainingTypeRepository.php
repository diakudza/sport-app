<?php
declare(strict_types=1);

namespace App\Repository;

use App\Models\TrainingType;
use Illuminate\Database\Eloquent\Collection;

class TrainingTypeRepository
{
    private $model = TrainingType::class;

    public function getAll(?array $with = null): Collection
    {
        return $this->model::query()->when($with, fn($q) => $q->with($with))->get();
    }
    public function getForEvent(int $event_id, ?array $with = null): Collection
    {
        return $this->model::query()->when($with, fn($q) => $q->with($with))
            ->whereRelation('event', fn($q) => $q->where('event_id', $event_id))
            ->get();
    }
}
