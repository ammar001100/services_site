<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('service_categories')->insert([
            [
                'name'=>'AC',
                'slug'=>'ac',
                'image'=>'1521969345.png',
            ],
            [
                'name'=>'AC',
                'slug'=>'ac',
                'image'=>'1521969358.png',
            ],
            [
                'name'=>'AC',
                'slug'=>'ac',
                'image'=>'1521969409.png',
            ],
            [
                'name'=>'AC',
                'slug'=>'ac',
                'image'=>'1521969419.png',
            ],
            [
                'name'=>'AC',
                'slug'=>'ac',
                'image'=>'1521969522.png',
            ],
            [
                'name'=>'AC',
                'slug'=>'ac',
                'image'=>'1521969576.png',
            ],
            [
                'name'=>'AC',
                'slug'=>'ac',
                'image'=>'1521969446.png',
            ]
            ]);
    }
}
