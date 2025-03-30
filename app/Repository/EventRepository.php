<?php
declare(strict_types=1);

namespace App\Repository;

use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;

class EventRepository
{
    private $model = Event::class;

    public function getAll(?array $with = null): Collection
    {
        return $this->model::query()
            ->when($with, fn($q) => $q->with($with))
            ->orderBy('date_start')
            ->get();
    }

    public function getForUser(int $userId, ?array $with = null): Collection
    {
        return $this->model::query()
            ->whereRelation('users', 'user_id', $userId)
            ->where('active', true)
            ->when($with, fn($q) => $q->with($with))
            ->get();
    }

    public function saveFromPlatform(Event $model, array $data): Event
    {
        $attachments = $data['attachment'] ?? [];
        unset($data['attachment']);

        $users = $data['users'] ?? [];
        unset($data['users']);

        $trainingTypes = $data['training_types'] ?? [];
        unset($data['training_types']);

        $model->fill($data)->save();

        if (!empty($attachments)) {
            $model->attachments()->sync($attachments);
        }
        if (!empty($users)) {
            $model->users()->sync($users);
        }
        if (!empty($trainingTypes)) {
            $model->training_types()->sync($trainingTypes);
        }

        return $model;
    }

    public function findById(int $id): Event | null
    {
        return $this->model::query()->with('attachment')->findOrFail($id);
    }

}
