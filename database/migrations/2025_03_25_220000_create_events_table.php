<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public $events = [
        [
            'name'=>'Весна бег',
            'short_description'=>'Только бег',
            'description'=>'Весна 2025',
            'date_start'=>'2025-01-01',
            'date_end'=>'2025-04-01',
            'active'=>true,
        ],
        [
            'name'=>'Весна 2025',
            'short_description'=>'Все активности',
            'description'=>'Весна 2025',
            'date_start'=>'2025-01-01',
            'date_end'=>'2025-05-01',
            'active'=>true,
        ],
    ];
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('short_description');
            $table->text('description')->nullable();
            $table->date('date_start');
            $table->date('date_end');
            $table->boolean('active')->default(false);
            $table->timestamps();
        });
        if (Schema::hasTable('events')) {
            DB::table('events')->insert($this->events);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
