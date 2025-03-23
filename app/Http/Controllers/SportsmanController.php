<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Filters\CarFilter;
use App\Http\Requests\CarRequest;
use App\Http\Resources\CarForSelectResource;
use App\Models\Car;
use App\Models\Training;
use App\Models\TrainingType;
use App\Models\TrainingVelo;
use App\Models\TrainingYoga;
use App\Service\TrainingService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isInstanceOf;

class SportsmanController extends Controller
{
    public function __construct(protected TrainingService $trainingService)
    {
    }

    public function index()
    {
        $trainingTypes = TrainingType::all();
        return view('sportsman.add-training', compact('trainingTypes'));
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
            'attachment'=> 'array',
            'attachment.*' => 'file'
        ]);

        $this->trainingService->saveTraining($data);
//        switch ($trainingTypes->model_class) {
//            case  TrainingVelo::class:
//                dd(' velo');
//                break;
//            case  TrainingYoga::class:
//                dd('yoga');
//                break;
//        }

        return view('sportsman.add-training');
    }
}
