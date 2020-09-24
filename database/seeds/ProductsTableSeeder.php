<?php

use App\Product;
use App\User;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Product::create([
            'category_id'  => 1,
            'user_id' => User::first()->id,
            'general_price'  => 10000,
            'slug'  => 'cangkir_kelapa',
            'name' => 'Cangkir Tempurung Kelapa',
            'image_name'  => 'cangkir.jpg',
            'description'  => 'Cangkir ini merupakan buatan tangan asli dari batok kelapa',
        ]);
        Product::create([
            'category_id'  => 2,
            'user_id' => User::first()->id,
            'general_price'  => 7000,
            'slug'  => 'kalung_kelapa',
            'name' => 'Kalung Tempurung Kelapa',
            'image_name'  => 'kalung.jpg',
            'description'  => 'Kalung ini merupakan buatan tangan asli dari batok kelapa',
        ]);
        Product::create([
            'category_id'  => 1,
            'user_id' => User::first()->id,
            'general_price'  => 12000,
            'slug'  => 'mangkok_kelapa',
            'name' => 'Mangkok Tempurung Kelapa',
            'image_name'  => 'mangkok.jpg',
            'description'  => 'Mangkok ini merupakan buatan tangan asli dari batok kelapa',
        ]);
        Product::create([
            'category_id'  => 2,
            'user_id' => User::first()->id,
            'general_price'  => 25000,
            'slug'  => 'lampion_kelapa',
            'name' => 'Lampion Tempurung Kelapa',
            'image_name'  => 'lampion.jpg',
            'description'  => 'Lampion ini merupakan buatan tangan asli dari batok kelapa',
        ]);
        Product::create([
            'category_id'  => 1,
            'user_id' => User::first()->id,
            'general_price'  => 6000,
            'slug'  => 'sendok_kelapa',
            'name' => 'Sendok Tempurung Kelapa',
            'image_name'  => 'sendok.jpg',
            'description'  => 'Sendok ini merupakan buatan tangan asli dari batok kelapa',
        ]);
        Product::create([
            'category_id'  => 1,
            'user_id' => User::first()->id,
            'general_price'  => 5000,
            'slug'  => 'gelang_kelapa',
            'name' => 'Gelang kelapa',
            'image_name'  => 'gelang.jpg',
            'description'  => 'Gelang ini merupakan buatan tangan asli dari batok kelapa',
        ]);
    }
}
