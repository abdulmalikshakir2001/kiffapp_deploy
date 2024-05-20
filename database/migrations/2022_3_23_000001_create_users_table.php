<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        #Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('username')->unique();
            // email not be null
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            // password not be nullabe
            $table->string('password')->nullable();
            // first name not be nullabe 

            $table->string('first_name')->nullable();
            $table->string('middle_names')->nullable();
            $table->string('last_name')->nullable();
            $table->date('dob')->nullable();
            // gender not be nullable
            $table->enum('gender', ['Male', 'Female', 'Other'])->default('Male')->nullable();
            $table->enum('blood_group', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-', 'Unknown'])->nullable();
            $table->enum('marital_status', ['Single', 'Married', 'Divorced', 'Widowed', 'Undisclosed'])->nullable();

            $table->string('profile_logo',255)->nullable();
            $table->text('address')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('city',50)->nullable();
            $table->string('state',50)->nullable();
            $table->string('landmark', 50)->nullable();
            $table->integer('country_id')->unsigned()->nullable();
            $table->string('mobile_number',50)->nullable();
            $table->string('phone_number',50)->nullable();

            $table->double('basic_salary',8,2)->default(0.00);
            $table->double('food_allownce',8,2)->default(0.00);
            $table->double('medical_allownce',8,2)->default(0.00);
            $table->double('transport_allownce',8,2)->default(0.00);
            $table->double('other_allownces',8,2)->default(0.00);
            


            $table->string('employee_no', 50)->nullable();
            $table->string('employee_tax_no',255)->nullable();
            $table->string('employee_cnic',50)->nullable();
            $table->string('employee_passport_number',255)->nullable();
            $table->string('employee_passport_copy',255)->nullable();
            $table->string('contract_copy',255)->nullable();
            $table->string('employee_cv',255)->nullable();
            $table->timestamp('employee_joining_date')->nullable();
            $table->string('tax_number')->nullable();
            $table->decimal('credit_limit', 22, 4)->nullable();
            $table->longText('bank_details')->nullable();

            $table->string('custom_field_1')->nullable();
            $table->string('custom_field_2')->nullable();
            $table->string('custom_field_3')->nullable();
            $table->string('custom_field_4')->nullable();
            $table->string('custom_field_5')->nullable();
            $table->string('custom_field_6')->nullable();
            $table->string('custom_field_7')->nullable();
            $table->string('custom_field_8')->nullable();
            $table->string('custom_field_9')->nullable();
            $table->string('custom_field_10')->nullable();

            $table->string('fb_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('social_media_1')->nullable();
            $table->string('social_media_2')->nullable();
            $table->string('social_media_3')->nullable();
            $table->string('social_media_4')->nullable();


            $table->integer('position_id')->unsigned()->nullable();
            $table->integer('department_id')->unsigned()->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('warehouse_id')->unsigned()->nullable()->default('0');
            $table->unsignedBigInteger('work_shift_id')->nullable();
            
            
            // user type not be nullable

            $table->enum('user_type', ['User', 'Owner', 'Employee', 'Supplier', 'Customer', 'JobCandidate', 'ContactOnly'])->default('User')->nullable();
            // language not be nullable
            $table->char('ui_language', 7)->default('en')->nullable();
            // allowed login not ben nullable
            $table->boolean('allow_login')->default(0)->nullable(); //by default user is not allowed to login
            // is active not be nullable
            $table->boolean('is_active')->default(0)->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
            // columns for chat messanger start 
            $table->integer('id')->unsigned()->nullable(); // for chatify
            $table->string('name',255)->nullable(); // for chatify
            $table->boolean('active_status')->default(0);// for chatify
            $table->string('avatar')->default(config('chatify.user_avatar.default'));// for chatify
            $table->boolean('dark_mode')->default(0);// for chatify
            $table->string('messenger_color')->default('#2180f3');// for chatify
            // columns for chat messanger end 
            //Forign Key Constrains
            $table->foreign('company_id')->references('company_id')->on('companies')->onDelete('cascade');
            
        });


        /**
         *
         * $data = User::find(1);
            if (empty($data)) {
                $user            = new User();
                $user->updated_by   = 1;
                $user->password  = Hash::make('123456');
                $user->created_at = date('Y-m-d h:i:s');
                $user->save();
            }
         */
        /** Now Insert Default App Admin Accounts to the Tables */
        DB::table('users')->insert([
            'username' => 'administrator',
            'email' => 'zorkif@outlook.com',
            'password' => Hash::make('zaratica@2030'),
            'first_name' => 'App',
            'last_name' => 'Administrator',
            'email_verified_at' => now(),
            'user_type' => 'Owner',
            'country_id' => 81,
            'company_id' => 1,
            'allow_login' => 1,
            'is_active' => 1,
            // thses two for messangeer start 
            'id' => 1,
            'name'=>'administrator'
            // thses two for messangeer end


        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
