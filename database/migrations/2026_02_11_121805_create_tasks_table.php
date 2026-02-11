<?php

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
    Schema::create('tasks', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description')->nullable();
        $table->enum('status', ['todo', 'doing', 'done'])->default('todo');
        $table->string('priority')->default('medium'); // A IA vai atualizar isso
        $table->json('ai_subtasks')->nullable();      // Guardaremos as subtarefas aqui
        $table->text('ai_reasoning')->nullable();     // Por que a IA deu essa prioridade?
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
