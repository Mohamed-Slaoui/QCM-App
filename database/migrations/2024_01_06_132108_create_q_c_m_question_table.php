<?php

use App\Models\QCM;
use App\Models\Question;
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
        Schema::create('q_c_m_question', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Question::class);
            $table->foreignIdFor(QCM::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('q_c_m_question');
    }
};
