<?php
declare(strict_types=1);

namespace App\Repository;

use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class EventRepository
{
    private $model = Event::class;

    public function getAll(?array $with = null): Collection
    {
        return $this->model::query()
//            ->where('approved', true)
            ->when($with, fn($q) => $q->with($with))
            ->get();
    }

    public function saveFromPlatform(Event $model, array $data): Event
    {
        $attachments = $data['attachment'] ?? [];
        unset($data['attachment']);

        $users = $data['users'] ?? [];
        unset($data['users']);

        $model->fill($data)->save();

        if (!empty($attachments)) {
            $model->attachments()->sync($attachments);
        }
        if (!empty($users)) {
            $model->users()->sync($users);
        }

        return $model;
    }

    public function findById(int $id): Event | null
    {
        return $this->model::query()->with('attachment')->findOrFail($id);
    }

}
