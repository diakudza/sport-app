<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public array $typeClass = [
        ['name' => 'Вело тренировка', 'model_class' => 'App\Models\TrainingBike', 'slug'=>'bike'],
        ['name' => 'Йога', 'model_class' => 'App\Models\TrainingYoga','slug'=>'yoga'],
        ['name' => 'Бег', 'model_class' => 'App\Models\TrainingRun','slug'=>'run'],
        ['name' => 'Силовая', 'model_class' => 'App\Models\TrainingStrong','slug'=>'strong'],
        ['name' => 'Групповая в зале', 'model_class' => 'App\Models\TrainingGroup','slug'=>'group'],
        ['name' => 'Единоборства', 'model_class' => 'App\Models\TrainingCombat','slug'=>'combat'],
        ['name' => 'Шаги', 'model_class' => 'App\Models\TrainingStep','slug'=>'step'],
    ];

    public function up(): void
    {
        Schema::create('training_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('model_class');
            $table->timestamps();
            $table->unique('name', 'model_class');
        });

        if (Schema::hasTable('training_types')) {
            DB::table('training_types')->insert($this->typeClass);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_types');
    }
};
