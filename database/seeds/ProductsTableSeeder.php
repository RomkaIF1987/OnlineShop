<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Apple',
                'price' => '0.3',
                'unit' => 'kg',
                'image' => 'apple.jpeg',
                'carousel' => 'active'
            ],
            [
                'name' => 'Beer',
                'price' => '2',
                'unit' => 'bottle',
                'image' => 'beer.jpeg',
                'carousel' => ''
            ],
            [
                'name' => 'Water',
                'price' => '1',
                'unit' => 'bottle',
                'image' => 'water.jpeg',
                'carousel' => ''
            ],
            [
                'name' => 'Cheese',
                'price' => '3.74',
                'unit' => 'kg',
                'image' => 'cheese.jpeg',
                'carousel' => ''
            ]]);
    }
}
