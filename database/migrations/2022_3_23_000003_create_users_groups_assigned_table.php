<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUsersGroupsAssignedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        #Schema::dropIfExists('users_groups_assigned');
        Schema::create('users_groups_assigned', function (Blueprint $table) {
            $table->increments('assign_id');
            $table->integer('user_id')->unsigned();
            $table->longText('groups')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });

        /** Now Insert Default App Admin Group to the Table */
        $group_one= DB::table('users_groups')->select('permissions') ->where('group_id',1)->get()->first();
        $group_one_per= $group_one->permissions;
        DB::table('users_groups_assigned')->insert([
            'assign_id' => '1',
            'user_id' => '1',
            'groups' => $group_one_per,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_groups_assigned');
    }
}
