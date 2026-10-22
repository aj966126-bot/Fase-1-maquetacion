<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('solicitudes')) {
            Schema::table('solicitudes', function (Blueprint $table) {
                $table->string('telefono', 10)->change();
            });

            if (!Schema::hasColumn('solicitudes', 'created_at')) {
                Schema::table('solicitudes', function (Blueprint $table) {
                    $table->timestamp('created_at')->nullable();
                });
            }

            if (!Schema::hasColumn('solicitudes', 'updated_at')) {
                Schema::table('solicitudes', function (Blueprint $table) {
                    $table->timestamp('updated_at')->nullable();
                });
            }

            if (Schema::hasColumn('solicitudes', 'fecha_registro')) {
                DB::statement('UPDATE solicitudes SET created_at = fecha_registro WHERE created_at IS NULL');
                DB::statement('UPDATE solicitudes SET updated_at = fecha_registro WHERE updated_at IS NULL');
            }

            return;
        }

        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('correo', 100);
            $table->string('telefono', 10);
            $table->string('empresa', 120);
            $table->string('sector', 50);
            $table->string('tamano', 30);
            $table->text('mensaje')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        if (Schema::hasColumn('solicitudes', 'fecha_registro')) {
            if (Schema::hasColumn('solicitudes', 'created_at')
                && Schema::hasColumn('solicitudes', 'updated_at')) {
                Schema::table('solicitudes', function (Blueprint $table) {
                    $table->dropTimestamps();
                });
            }

            Schema::table('solicitudes', function (Blueprint $table) {
                $table->string('telefono', 20)->change();
            });

            return;
        }

        Schema::dropIfExists('solicitudes');
    }
};