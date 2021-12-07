<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vente', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('dateVente', 10)->nullable();
            $table->double('prix_paye', 7, 2);
            $table->integer('quantite')->default(1);
            $table->integer('client_id')->nullable()->index('client_id');
            $table->integer('voyage_id')->nullable()->index('voyage_id');
            $table->timestamp('created_at')->nullable();
            $table->boolean('etat')->default(true);
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vente');
    }
}
