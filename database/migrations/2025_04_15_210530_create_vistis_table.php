<?php

use App\Enums\VisitsStatusEnum;
use App\Models\City;
use App\Models\Delegate;
use App\Models\Doctor;
use App\Models\Region;
use App\Models\Sample;
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
        Schema::create('vistis', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Delegate::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Doctor::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Region::class)->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('visit_date');
            $table->time('visti_time');
            $table->string('note')->nullable();
            $table->string('outcome')->nullable();
            $table->tinyInteger('status')->default(VisitsStatusEnum::PENDING->value);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vistis');
    }
};
