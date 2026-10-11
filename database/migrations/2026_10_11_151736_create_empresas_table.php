
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 100);
            $table->string('direccion', 150);
            $table->string('telefono', 20);

            $table->unsignedInteger('usuario_id');

            $table->foreign('usuario_id')
                  ->references('id')
                  ->on('usuarios');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
