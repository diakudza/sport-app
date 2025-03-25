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

    public function getRatingsUserGrouped(): Collection
    {
        return $this->model::query()
            ->where('approved', true)
            ->select('user_id', DB::raw('SUM(points) as total_points'))
            ->groupBy('user_id')
            ->orderByDesc('total_points')
            ->get();
    }

    public function getTrainingsByUserId($user_id): Collection
    {
        return $this->model::query()->where('user_id', $user_id)
            ->with('trainable')
            ->get();
    }

    public function findById(int $id): Training | null
    {
        return $this->model::query()->with('attachment')->findOrFail($id);
    }

}
