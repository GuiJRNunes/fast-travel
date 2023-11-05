<?php

use App\Enum\TourStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->string('image_link');
            $table->string('title');
            $table->text('description');
            $table->date('departure_date');
            $table->date('return_date');
            $table->integer('capacity');
            $table->decimal('price_per_passenger', /* total digits */ 8, /* decimal digits */ 2);
            $table->enum('status', array_column(TourStatusEnum::cases(), 'value'))->default(TourStatusEnum::UNDER_MAINTENANCE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
