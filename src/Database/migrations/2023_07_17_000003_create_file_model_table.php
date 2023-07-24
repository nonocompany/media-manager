<?php
/**
 * Created by Egemen KIRKAPLAN - egemen.k@nono.company
 * Created on 17.07.2023
 * Project: Media Manager
 * Package: nonocompany\media-manager
 * File: 2023_07_17_000003_create_media_model_table.php
 * Description: Media Manager migration file.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('file_model', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('file_id')->constrained('files', 'id');
            $table->uuidMorphs('model');
            $table->string('key')->nullable();
            $table->unsignedInteger('order')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_model');
    }
};
