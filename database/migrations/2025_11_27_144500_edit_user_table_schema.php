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

            $table->string("FIRST_NAME")->after("id");
            $table->string("LAST_NAME")->nullable()->after("FIRST_NAME");
            $table->renameColumn("email", "EMAIL");
            $table->renameColumn("password", "PASSWORD");
            $table->string("PHONE")->nullable()->after("EMAIL");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("users", function (Blueprint $table) {
            $table->dropColumn(["FIRST_NAME", "LAST_NAME", "PHONE"]);

            $table->string("name")->after("id");
            $table->timestamp("email_verified_at")->nullable()->after("EMAIL");
            $table->string("remember_token", 100)->nullable()->after("PASSWORD");
            $table->renameColumn("EMAIL", "email");
            $table->renameColumn("PASSWORD", "password");
        });
    }
};
