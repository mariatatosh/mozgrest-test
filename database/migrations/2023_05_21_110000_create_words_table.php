<?php

declare(strict_types=1);

use App\Models\Language;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('words', static function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->foreignIdFor(Language::class)->constrained()->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('words');
    }
};