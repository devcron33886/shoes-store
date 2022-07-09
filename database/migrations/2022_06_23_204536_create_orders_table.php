<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->string('email');
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('shipping_address_id')->nullable()->constrained();
            $table->foreignId('shipping_type_id')->nullable()->constrained();
            $table->foreignId('payment_method_id')->nullable()->constrained();
            $table->integer('subtotal');
            $table->timestamp('placed_at');
            $table->timestamp('packaged_at')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
