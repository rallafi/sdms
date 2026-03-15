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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title'); 
            $table->text('description')->nullable(); 
            $table->unsignedBigInteger('category_id'); 
            $table->string('file_name'); 
            $table->string('file_path'); 
            $table->unsignedBigInteger('file_size')->nullable(); 
            $table->string('file_type')->nullable(); 
            $table->unsignedBigInteger('uploaded_by'); 
            $table->unsignedBigInteger('last_edited_by')->nullable(); 
            $table->boolean('is_reserved')->default(false); 
            $table->timestamps(); 

            // Foreign keys
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->cascadeOnDelete();

            $table->foreign('uploaded_by')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreign('last_edited_by')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};

