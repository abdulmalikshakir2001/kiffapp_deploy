<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class CreateCompaniesDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies_departments', function (Blueprint $table) {
            $table->increments('department_id');
            $table->string('department_name');
            $table->integer('company_id')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();

            //Forign Key Constrains
            $table->foreign('company_id')->references('company_id')->on('companies')->onDelete('cascade');
        });
        /** Now Insert Default App Admin Accounts to the Tables */
        DB::table('companies_departments')->insert([
            'department_name' => 'AppAdministrator',
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
        Schema::dropIfExists('companies_departments');
    }
}
