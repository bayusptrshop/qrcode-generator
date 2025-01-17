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
        Schema::create('traceability_raw_materials', function (Blueprint $table) {
            $table->string('rm_id')->primary();
            $table->string('model_name');
            $table->string('item_code',20);
            $table->bigInteger('po_no');
            $table->string('cus_info_1')->nullable();
            $table->string('cus_info_2')->nullable();
            $table->integer('qty');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traceability_raw_materials');
    }
};
