<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\account\AccFamily;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acc_families', function (Blueprint $table) {
            $table->increments('acc_family_id');

            $table->string('family_code',255)->unique();
            $table->enum('family_name',['drawings','expense','assets','liability','equity','revenue']);
            $table->timestamps();
        });

        // insert family names and code start 
        $familyNamesArray =  ['drawings','expense','assets','liability','equity','revenue'];
        $i=1;
        foreach($familyNamesArray as  $familyName){
            AccFamily::create([
                
                'family_code'=>$i,
                'family_name'=>$familyName
            ]);
            $i++;

        }
        // insert family names and code end

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acc_families');
    }
};
