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
        Schema::create('acc_accounts', function (Blueprint $table) {
            $table->increments('acc_account_id');
            $table->integer('company_id')->unsigned();
            $table->string('name',255);
            $table->string('code',255);
            $table->string('type',255);
            $table->decimal('opening_balance',10,2)->default(0.00);
            $table->text('remarks')->nullable();

            


            $table->foreign('company_id')
            ->references('company_id')->on('companies')
            ->onDelete('cascade');
            
            $table->foreign('type')
            ->references('family_code')->on('acc_families')
            ->onDelete('cascade');
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
        Schema::dropIfExists('acc_accounts');
    }
};
