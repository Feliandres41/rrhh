<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contract_extensions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('contract_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->date('new_end_date');

            $table->string('reason')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contract_extensions');
    }
};
