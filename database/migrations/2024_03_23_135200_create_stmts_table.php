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
        Schema::create('stmts', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->nullable()->comment('Время создания заявки');
            $table->timestamp('updated_at')->nullable()->comment('Время ответа на заявку');
            $table->softDeletes();
            $table->string('name')->comment('Имя пользователя');
            $table->string('email')->comment('Email пользователя');
            $table->enum('status', ['Active', 'Resolved'])->nullable()->comment('Статус');
            $table->text('message')->comment('Сообщение пользователя');
            $table->text('comment')->comment('Ответ ответственного лица')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stmts');
    }
};
