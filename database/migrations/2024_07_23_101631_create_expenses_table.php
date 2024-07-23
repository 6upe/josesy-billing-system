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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('supplier_name');
            $table->string('supplier_contact');
            $table->text('supporting_documents')->nullable();
            $table->text('products_purchased');
            $table->decimal('amount', 15, 2);
            $table->decimal('unit_price', 15, 2);
            $table->integer('quantity');
            $table->string('expense_type');
            $table->date('date_of_expense')->default(DB::raw('CURRENT_DATE'));
            $table->text('description')->nullable();
            $table->string('approval_status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
