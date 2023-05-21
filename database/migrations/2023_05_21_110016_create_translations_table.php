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
        Schema::create('translations', static function (Blueprint $table) {
            $table->foreignIdFor(Word::class, 'word_id1')->constrained('words')->cascadeOnDelete();
            $table->foreignIdFor(Word::class, 'word_id2')->constrained('words')->cascadeOnDelete();

            $table->unique(['word_id1', 'word_id2']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('translations');
    }
};
