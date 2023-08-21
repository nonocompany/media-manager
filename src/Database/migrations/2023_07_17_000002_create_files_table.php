<?php
/**
 * Created by Egemen KIRKAPLAN - egemen.k@nono.company
 * Created on 17.07.2023
 * Project: Media Manager
 * Package: nonocompany\media-manager
 * File: 2023_07_17_000002_create_medias_table.php
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
        Schema::create('files', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('folder_id')->nullable()->constrained();
            $table->boolean('is_clone')->default(false);
            $table->uuid('original_id')->nullable();
            $table->string('slug');
            $table->string('name');
            $table->string('hash_name');
            $table->string('mime_type');
            $table->string('extension');
            $table->unsignedBigInteger('size')->nullable();
            $table->string('disk');
            $table->unsignedInteger('width')->nullable();
            $table->unsignedInteger('height')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
