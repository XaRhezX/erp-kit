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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('username', 35)->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->unsignedInteger('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->boolean('is_disabled')->nullable()->default(0);

            $table->unsignedInteger('created_at');
            $table->foreignUuid('created_by')->nullable();
            $table->unsignedInteger('updated_at');
            $table->foreignUuid('updated_by')->nullable();
            $table->unsignedInteger('deleted_at')->nullable();
            $table->foreignUuid('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};