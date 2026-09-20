<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('copper_prices', function (Blueprint $table) {
            $table->comment('Copper Price Record');
            $table->bigIncrements('id')->comment('ID');
            $table->date('price_date')->index('cp_date')->comment('Price Date');
            $table->string('market', 20)->index('cp_market')->comment('Market: ccmn/smm/lme');
            $table->decimal('copper_price', 15, 4)->default(0)->comment('Copper Average Price');
            $table->string('currency', 10)->default('cny')->comment('Currency: cny/usd');
            $table->timestamps();
            $table->unique(['price_date', 'market'], 'cp_date_market_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('copper_prices');
    }
};
