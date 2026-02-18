<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('collaborator_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->enum('contract_type', [
                'fixed_term',
                'indefinite',
                'service_contract'
            ]);

            $table->date('start_date');
            $table->date('end_date')->nullable();

            $table->decimal('salary', 12, 2)->nullable();

            $table->enum('status', [
                'vigente',
                'terminado'
            ])->default('vigente');


            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
