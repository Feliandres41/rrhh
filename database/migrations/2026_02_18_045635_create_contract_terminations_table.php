<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contract_terminations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('contract_id')
                  ->unique()
                  ->constrained()
                  ->cascadeOnDelete();

            $table->date('termination_date');

            $table->enum('termination_type', [
                'with_just_cause',
                'without_just_cause',
                'mutual_agreement'
            ]);

            $table->text('reason')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contract_terminations');
    }
};
