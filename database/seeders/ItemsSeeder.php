<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemsSeeder extends Seeder
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
                'code_item' => 'M0001',
                'name_item' => 'Barang M',
                'price_item' => 300000
            ],
            [
                'code_item' => 'D0001',
                'name_item' => 'Barang D',
                'price_item' => 250000
            ],
            [
                'code_item' => 'C0001',
                'name_item' => 'Barang C',
                'price_item' => 200000
            ],
            [
                'code_item' => 'M0002',
                'name_item' => 'Barang M2',
                'price_item' => 350000
            ],
            [
                'code_item' => 'A0001',
                'name_item' => 'Barang A',
                'price_item' => 150000
            ],
            [
                'code_item' => 'C0002',
                'name_item' => 'Barang C2',
                'price_item' => 120000
            ],
        ];



        foreach ($products as $key => $value) {
            Item::create($value);
        }
    }
}
