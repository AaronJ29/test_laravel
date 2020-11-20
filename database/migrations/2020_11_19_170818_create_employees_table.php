<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id', 11);
            $table->string('codigo', 40)->nullable(false);
            $table->string('nombre', 120)->nullable(false);
            $table->decimal('salarioDolares', 10,2);
            $table->decimal('salarioPesos', 10,2);
            $table->string('direccion', 250)->nullable(false);
            $table->string('estado', 50)->nullable(false);
            $table->string('ciudad', 50)->nullable(false);
            $table->string('telefono', 10)->nullable(false);
            $table->string('correo', 100)->nullable(false);
            $table->tinyInteger('activo')->default('0');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
