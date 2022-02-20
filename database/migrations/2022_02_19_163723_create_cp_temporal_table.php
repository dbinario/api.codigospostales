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
        Schema::create('cp_temporal', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->id();
            $table->string('d_codigo')->default('');
            $table->string('d_asenta')->default('');
            $table->string('d_tipo_asenta')->default('');
            $table->string('d_mnpio')->default('');
            $table->string('d_estado')->default('');
            $table->string('d_ciudad')->default('');
            $table->string('d_CP')->default('');
            $table->string('c_estado')->default('');
            $table->string('c_oficina')->default('');
            $table->string('c_CP')->default('');
            $table->string('c_tipo_asenta')->default('');
            $table->string('c_mnpio')->default('');
            $table->string('id_asenta_cpcons')->default('');
            $table->string('d_zona')->default('');
            $table->string('c_cve_ciudad')->default('');
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
        Schema::dropIfExists('c_p_temporals');
    }
};
