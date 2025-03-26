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

final class SportsmanController extends Controller
{
    public function __construct(
        protected TrainingService $trainingService,
        protected TrainingRepository $trainingRepository,
        protected TrainingTypeRepository $trainingTypeRepository,
        protected EventRepository $eventRepository,
    )
    {
    }

    public function index()
    {
        $events = $this->eventRepository->getForUser(auth()->id());
        $trainingTypes = $this->trainingTypeRepository->getAll();
        return view('sportsman.add-training', compact('trainingTypes', 'events' ));
    }

    /**
     * @throws \Exception
     */
    public function add(Request $request)
    {
        $data = $request->validate([
            'type' => 'required',
            'training' => 'required|array',
            'user_id' => 'required|exists:users,id',
            'attachment' => 'array',
            'attachment.*' => 'file',
            'event_id' => 'required|exists:events,id',
        ]);

        $this->trainingService->saveTraining($data);

        return redirect()->route('home');
    }

    public function trainings(Request $request)
    {
        $trainings = $this->trainingRepository->getTrainingsByUserId(auth()->user()->id);
        return view('sportsman.your-training', ['trainings' => $trainings]);
    }
}
