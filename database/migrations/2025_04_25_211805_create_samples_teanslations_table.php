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
        Schema::create('sample_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Sample::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('locale')->index();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unique(['sample_id', 'locale']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('samples_teanslations');
    }
};
