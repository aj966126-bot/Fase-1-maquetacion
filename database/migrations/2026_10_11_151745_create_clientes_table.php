
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 100);
            $table->string('correo', 100);
            $table->string('telefono', 20);

            $table->unsignedInteger('empresa_id');

            $table->foreign('empresa_id')
                  ->references('id')
                  ->on('empresas');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
