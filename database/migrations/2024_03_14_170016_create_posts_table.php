<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->longText('content');
            $table->string('status')->default('inactive');
            $table->timestamp('published_at');
            $table->boolean('is_mail')->default(false);
            $table->foreignId('event_id')->nullable()->index();
            $table->foreignId('team_id')->index();
            $table->foreignId('created_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }
};
