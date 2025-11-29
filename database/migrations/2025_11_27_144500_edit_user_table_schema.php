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
        Schema::table("users", function (Blueprint $table) {
            $table->dropColumn(["name", "email_verified_at", "remember_token"]);

            $table->string("first_name")->after("id");
            $table->string("last_name")->nullable()->after("first_name");
            $table->string("phone")->nullable()->after("email");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("users", function (Blueprint $table) {
            $table->dropColumn(["first_name", "last_name", "phone"]);

            $table->string("name")->after("id");
            $table->timestamp("email_verified_at")->nullable()->after("email");
            $table->string("remember_token", 100)->nullable()->after("password");
        });
    }
};
