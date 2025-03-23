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
        ['name' => 'Вело тренировка', 'model_class' => 'App\Models\TrainingBike'],
        ['name' => 'Йога', 'model_class' => 'App\Models\TrainingYoga'],
        ['name' => 'Бег', 'model_class' => 'App\Models\TrainingRun'],
        ['name' => 'Силовая', 'model_class' => 'App\Models\TrainingStrong'],
        ['name' => 'Групповая в зале', 'model_class' => 'App\Models\TrainingGroup'],
        ['name' => 'Единоборства', 'model_class' => 'App\Models\TrainingCombat'],
        ['name' => 'Шаги', 'model_class' => 'App\Models\TrainingStep'],
    ];

    public function up(): void
    {
        Schema::create('training_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
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
