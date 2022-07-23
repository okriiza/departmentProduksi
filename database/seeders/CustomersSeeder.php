<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'code_customer' => 'CUST-' . date('Ym') . '-' . rand(1, 9999),
                'name_customer' => 'Customer A',
                'phone_customer' => '08' . rand(1, 9999999999),
            ],
            [
                'code_customer' => 'CUST-' . date('Ym') . '-' . rand(1, 9999),
                'name_customer' => 'Customer B',
                'phone_customer' => '08' . rand(1, 9999999999),
            ],
            [
                'code_customer' => 'CUST-' . date('Ym') . '-' . rand(1, 9999),
                'name_customer' => 'Customer C',
                'phone_customer' => '08' . rand(1, 9999999999),
            ],
        ];



        foreach ($products as $key => $value) {
            Customer::create($value);
        }
    }
}
