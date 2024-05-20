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
        Schema::create('crm_oppertunities', function (Blueprint $table) {
            $table->increments('oppertunity_id');
            $table->integer('company_id')->unsigned();
            $table->text('subject')->nullable();
            $table->integer('contact_id')->unsigned();
            $table->integer('employee_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('lead_id')->unsigned();
            
            $table->integer('expected_revenue');
            $table->enum('priority',['lowest','low','normal','high','highest']);
            $table->string('lead_reffered_by',255)->nullable();
            $table->string('next_action_remarks',255)->nullable();
            $table->date('next_action_date')->nullable();
            $table->date('next_action_closing_date')->nullable();
            $table->text('internal_notes')->nullable();
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
        Schema::dropIfExists('crm_oppertunities');
    }
};
