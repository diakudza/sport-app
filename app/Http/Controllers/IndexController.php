<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Filters\CarFilter;
use App\Http\Requests\CarRequest;
use App\Http\Resources\CarForSelectResource;
use App\Models\Car;
use App\Models\Training;
use App\Repository\EventRepository;
use App\Repository\TrainingRepository;
use App\Repository\TrainingTypeRepository;
use App\Service\TrainingService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

final class IndexController extends Controller
{
    public function __construct(
        protected TrainingService $trainingService,
        protected TrainingRepository $trainingRepository,
        protected EventRepository $eventRepository,
    )
    {
    }

    public function index()
    {
        $eventTrainings = $this->trainingRepository->getGroupedByEvents(['user','type','trainable','event']);
        $ratings = $this->trainingRepository->getRatingsUserGrouped();
        $events = $this->eventRepository->getAll();

        return view('index', compact('eventTrainings', 'ratings', 'events'));
    }

}
