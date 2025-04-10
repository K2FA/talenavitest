<?php

use App\Enums\Enums\TodoPriority;
use App\Enums\TodoStatus;
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
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('assignee')->nullable();
            $table->date('due_date');
            $table->decimal('time_tracked', 8, 2)->default(0);
            $table->enum('status', TodoStatus::values())->default(TodoStatus::PENDING->value);
            $table->enum('priority', TodoPriority::values());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todos');
    }
};
