<?php

declare(strict_types=1);

use App\Models\Word;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('word_examples', static function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Word::class)->constrained()->cascadeOnDelete();
            $table->string('original');
            $table->string('translation');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('word_examples');
    }
};
