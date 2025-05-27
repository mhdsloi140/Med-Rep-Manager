<?php

use App\Models\User;
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
        Schema::create('delegate_supervisors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // $table->foreignIdFor(Visti::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();

            // $table->foreignIdFor(model: User::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('phone')->nullable();
            $table->string('image',10)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delegate_supervisors');
    }
};
