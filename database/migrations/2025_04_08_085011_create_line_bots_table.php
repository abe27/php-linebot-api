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
        Schema::create('line_bots', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('line_user_id')->constrained();
            $table->string('message_source'); // group,user
            $table->foreignUlid('line_group_id')->nullable()->constrained();
            $table->string('message_type');
            $table->string('message');
            $table->string('reply_token');
            $table->boolean('is_replyed')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('line_bots');
    }
};
