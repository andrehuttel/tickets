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
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('name');
            $table->string('place');
            $table->string('place_address');
            $table->date('date');
            $table->dateTime('date_opening');
            $table->string('image');
            $table->text('description');
            $table->text('description_append')->nullable();
            $table->string('map')->nullable();
            $table->string('organizer');
            $table->longText('organizer_logo');
            $table->string('organizer_instagram');
            $table->string('organizer_facebook');
            $table->string('classification');
            $table->string('link_share_whatsapp')->nullable();
            $table->string('link_share_facebook')->nullable();
            $table->string('link_share_twitter')->nullable();
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
