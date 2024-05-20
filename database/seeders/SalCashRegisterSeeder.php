<?php

namespace Database\Seeders;
use App\Models\sale\SalCashRegister;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalCashRegisterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        SalCashRegister::factory()->count(3)->make();

    }
}
