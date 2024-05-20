<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCompaniesPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies_positions', function (Blueprint $table) {
            $table->increments('position_id');
            $table->string('position_name');
            $table->integer('company_id')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();

            //Forign Key Constrains
            $table->foreign('company_id')->references('company_id')->on('companies')->onDelete('cascade');
        });

        /** Now Insert Default App Admin Accounts to the Tables */
        DB::table('companies_positions')->insert([
            'position_name' => 'AppAdministrator',
            'company_id' => '1'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies_positions');
    }
}
