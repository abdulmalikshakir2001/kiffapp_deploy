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
        Schema::create('employee_leaves', function (Blueprint $table) {
            $table->id('employee_leave_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('leave_type_id');
            $table->unsignedBigInteger('company_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('is_paid',['paid','unpaid']);
            $table->enum('approval_status',['pending','approved','rejected'])->default('pending');
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
        Schema::dropIfExists('employee_leaves');
    }
};
