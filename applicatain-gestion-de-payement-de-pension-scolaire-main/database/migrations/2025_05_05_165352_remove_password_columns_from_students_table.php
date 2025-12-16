<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['initial_password', 'final_password']);
        });
    }
    
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('initial_password')->unique();
            $table->string('final_password')->nullable();
        });
    }
    
};
