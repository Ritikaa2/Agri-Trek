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
        if (Schema::hasTable('schemes')) {
            $columns = Schema::getColumnListing('schemes');

            Schema::table('schemes', function (Blueprint $table) use ($columns) {
                if (! in_array('title', $columns, true)) {
                    $table->string('title')->nullable();
                }

                if (! in_array('description', $columns, true)) {
                    $table->text('description')->nullable();
                }

                if (! in_array('eligibility_criteria', $columns, true)) {
                    $table->text('eligibility_criteria')->nullable();
                }

                if (! in_array('max_beneficiaries', $columns, true)) {
                    $table->integer('max_beneficiaries')->nullable();
                }

                if (! in_array('status', $columns, true)) {
                    $table->string('status')->default('active');
                }

                if (! in_array('created_at', $columns, true)) {
                    $table->timestamp('created_at')->nullable();
                }

                if (! in_array('updated_at', $columns, true)) {
                    $table->timestamp('updated_at')->nullable();
                }
            });

            return;
        }

        Schema::create('schemes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('eligibility_criteria')->nullable();
            $table->integer('max_beneficiaries')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schemes');
    }
};
