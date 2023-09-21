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
        Schema::create('events', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('company_id');
            $table->string('name');
            $table->date('date');
            $table->time('start_hour');
            $table->time('place_open_hour');
            $table->text('description');
            $table->text('description_append')->nullable();
            $table->longText('image');
            $table->longText('event_map_image')->nullable();
            $table->string('category_id')->nullable();
            $table->string('category_name')->nullable();
            $table->string('group_id')->nullable();
            $table->string('group_name')->nullable();
            $table->string('place_id')->nullable();
            $table->string('place_name')->nullable();
            $table->string('place_address')->nullable();
            $table->string('organizer_id')->nullable();
            $table->string('organizer_name')->nullable();
            $table->longText('organizer_logo')->nullable();
            $table->boolean('fl_show_payment_methods')->nullable();
            $table->boolean('fl_show_organizer')->nullable();
            $table->boolean('fl_show_classification')->nullable();
            $table->boolean('fl_featured')->nullable();
            $table->string('classification_text')->nullable();
            $table->timestamps();

            // Defina a chave estrangeira para a tabela "company"
            $table->foreign('company_id')->references('id')->on('company')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
