<?php

namespace Database\Factories\sale;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\sale\SalCashRegister>
 */
class SalCashRegisterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'=>2,
  'company_id'=>2,
  'status'=>'',
  'closed_at'=>now(),
  'closing_amount'=>3000,
        ];
    }
}
