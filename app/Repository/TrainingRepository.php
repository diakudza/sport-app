<?php
declare(strict_types=1);

namespace App\Repository;

use App\Models\Training;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class TrainingRepository
{
    private $model = Training::class;

    public function getAll(?array $with = null): Collection
    {
        return $this->model::query()
            ->where('approved', true)
            ->when($with, fn($q) => $q->with($with))
            ->get();
    }

    public function getGroupedByEvents(?array $with = null): Collection
    {
        return $this->model::query()
            ->where('approved', true)
            ->whereHas('event', function ($query) {
                $query->where('date_end', '>', DB::raw('NOW()'));
                $query->where('active', true);
            })
            ->when($with, fn($q) => $q->with($with))
            ->get()
            ->groupBy('event.name');
    }

    public function getRatingsUserGrouped(): Collection
    {
        return $this->model::query()
            ->join('events', 'events.id', '=', 'trainings.event_id')
            ->where('trainings.approved', true)
            ->where('events.date_end', '>', DB::raw('NOW()'))
            ->where('events.active', true)
            ->select('events.name as event_name', 'trainings.user_id', DB::raw('SUM(trainings.points) as total_points'))
            ->groupBy('events.name', 'trainings.user_id')
            ->orderByDesc('total_points')
            ->get()
            ->groupBy('event_name');
    }

    public function getTrainingsByUserId($user_id): Collection
    {
        return $this->model::query()->where('user_id', $user_id)
            ->with(['trainable', 'event'])
            ->get();
    }

    public function findById(int $id): Training|null
    {
        return $this->model::query()->with('attachment')->findOrFail($id);
    }

}
