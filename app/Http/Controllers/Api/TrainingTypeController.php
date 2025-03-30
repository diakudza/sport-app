<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\TrainingTypeRepository;
use Illuminate\Http\Request;

final class TrainingTypeController extends Controller
{
    public function __construct(
        protected TrainingTypeRepository $trainingTypeRepository
    )
    {
    }

    public function forEvent(Request $request)
    {
       $eventId = $request->input('event_id');
        $trainingType = $this->trainingTypeRepository->getForEvent((int)$eventId)->pluck('name', 'id');
        $trainingType = $trainingType->prepend('Выберите тип тренировки');
//dd($trainingType);
        return response()->json($trainingType);
    }
}
