<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUsersGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        #Schema::dropIfExists('users_groups');
        Schema::create('users_groups', function (Blueprint $table) {
            $table->increments('group_id');
            $table->string('group_name')->nullable();
            $table->longText('permissions')->nullable();
            $table->integer('company_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('company_id')->references('company_id')->on('companies')->onDelete('cascade');
        });

        /** Now Insert Default App Admin Group to the Table */
        DB::table('users_groups')->insert([
            'group_id' => '1',
            'group_name' => 'AppAdministrators',
            'permissions' => 'AppAdministrator', // By Default this group will  have access to all modules and forms of the application
            'company_id' => '1',
        ]);
        DB::table('users_groups')->insert([
            'group_id' => '2',
            'group_name' => 'BusinessAdministrator',
            'permissions' => 'Customers', // By Default this group will  have access to all modules and forms of the application
            'company_id' => '1',
        ]);
        
        DB::table('users_groups')->insert([
            'group_id' => '3',
            'group_name' => 'everyone',
            'permissions' => 'Profile,ChangePassword,Notifications,Messages,ToDoTasks,NotificationsPreferences,Logout', // By Default this group will  have access to all modules and forms of the application
            'company_id' => '1',
        ]);
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_groups');
    }
}
