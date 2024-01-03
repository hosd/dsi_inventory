<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_sliders', function (Blueprint $table) {
            $table->id();
            $table->string('image', 255);
            $table->string('heading_1_en', 255);
            $table->string('heading_1_si', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('heading_1_ta', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('heading_2_en', 255);
            $table->string('heading_2_si', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('heading_2_ta', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->longText('caption_en');
            $table->longText('caption_si')->collation('utf8mb4_unicode_ci')->nullable();
            $table->longText('caption_ta')->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('url', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('main_sliders');
    }
};
