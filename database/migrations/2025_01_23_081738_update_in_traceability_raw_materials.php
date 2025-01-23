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
        Schema::table('traceability_raw_materials', function (Blueprint $table) {
            $table->renameColumn('cus_info_1', 'prod_date');
            $table->renameColumn('cus_info_2', 'batch_no');
            $table->string('furnace_no')->nullable();
            $table->integer('total_pallet')->nullable();
            $table->string('item_code')->nullable()->change();
            $table->renameColumn('po_no', 'invoice_no');
            $table->string('invoice_no')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('traceability_raw_materials', function (Blueprint $table) {
            $table->renameColumn('prod_date', 'cus_info_1');
            $table->renameColumn('batch_no', 'cus_info_2');
            $table->dropColumn('furnace_no');
            $table->dropColumn('total_pallet');
            $table->string('item_code')->nullable(false)->change();
            $table->renameColumn('invoice_no', 'po_no');
            $table->bigInteger('po_no')->change();
        });
    }
};
