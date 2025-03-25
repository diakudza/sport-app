<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Filters\CarFilter;
use App\Http\Requests\CarRequest;
use App\Http\Resources\CarForSelectResource;
use App\Models\Car;
use App\Models\Training;
use App\Repository\TrainingRepository;
use App\Repository\TrainingTypeRepository;
use App\Service\TrainingService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

final class TrainingController extends Controller
{
    public function __construct(
        protected TrainingService $trainingService,
        protected TrainingRepository $trainingRepository
    )
    {
    }

    public function index()
    {
        $trainings = $this->trainingRepository->getAll(['user','type','trainable']);
        $ratings = $this->trainingRepository->getRatingsUserGrouped();
        return view('index', compact('trainings', 'ratings'));
    }

    public function detail(int $id)
    {
        $training = $this->trainingRepository->findById($id);

        return view('trainings.training-detail', compact('training',));
    }
}
