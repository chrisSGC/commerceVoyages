<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoyageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voyage', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nomVoyage', 250)->nullable()->index('nomVoyage');
            $table->date('dateDebut')->nullable();
            $table->integer('duree')->nullable();
            $table->string('ville', 100)->nullable();
            $table->decimal('prix', 7)->nullable();
            $table->integer('departement_id')->nullable()->index('departement_id');
            $table->integer('categorie_id')->nullable()->index('categorie_id');
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voyage');
    }
}
