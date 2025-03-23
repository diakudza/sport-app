<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Filters\CarFilter;
use App\Http\Requests\CarRequest;
use App\Http\Resources\CarForSelectResource;
use App\Models\Car;
use App\Models\Training;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class TrainingController extends Controller
{
    public function index()
    {
        $trainings = Training::query()->with(['user','type','trainable'])->get();
        $ratings = Training::select('user_id', DB::raw('SUM(points) as total_points'))
            ->groupBy('user_id')
            ->orderByDesc('total_points')
            ->get();

        return view('index', compact('trainings', 'ratings'));
    }
}
