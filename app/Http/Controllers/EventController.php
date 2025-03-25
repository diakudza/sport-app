<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Filters\CarFilter;
use App\Http\Requests\CarRequest;
use App\Http\Resources\CarForSelectResource;
use App\Models\Car;
use App\Models\Training;
use App\Models\TrainingType;
use App\Models\TrainingBike;
use App\Models\TrainingYoga;
use App\Repository\EventRepository;
use App\Repository\TrainingRepository;
use App\Repository\TrainingTypeRepository;
use App\Service\TrainingService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isInstanceOf;

final class EventController extends Controller
{
    public function __construct(
        protected EventRepository $eventRepository,
    )
    {
    }

    public function index()
    {
        $events = $this->eventRepository->getAll(['attachment']);
        return view('events.event-list', compact('events'));
    }

    public function detail(int $id) {
        $event = $this->eventRepository->findById($id);
        return view('events.event-detail', compact('event'));
    }
}
