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
        if (! Schema::hasTable('schemes')) {
            return;
        }

        $columns = Schema::getColumnListing('schemes');

        Schema::table('schemes', function (Blueprint $table) use ($columns) {
            if (! in_array('name', $columns, true)) {
                $table->string('name')->nullable();
            }

            if (! in_array('benefits', $columns, true)) {
                $table->text('benefits')->nullable();
            }

            if (! in_array('deadline', $columns, true)) {
                $table->date('deadline')->nullable();
            }

            if (! in_array('government_link', $columns, true)) {
                $table->string('government_link')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schemes', function (Blueprint $table) {
            $table->dropColumn(['name', 'benefits', 'deadline', 'government_link']);
        });
    }
};
