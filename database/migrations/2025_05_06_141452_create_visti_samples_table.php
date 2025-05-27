<?php

use App\Models\Sample;
use App\Models\Visti;
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
        Schema::create('visti_samples', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Visti::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Sample ::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
             $table->enum('status', ['delivered', 'not_delivered'])->default('not_delivered');

            $table->integer('quantity')->default(1);
            $table->text('note')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visti_samples');
    }
};
