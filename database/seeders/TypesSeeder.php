<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $params = [
            [
                'name' => '食費',
                'category' => 0,
            ],
            [
                'name' => '雑費',
                'category' => 0,
            ],
            [
                'name' => '給与',
                'category' => 1,
            ],
        ];

        foreach($params as $param){
            DB::table('types')->insert($param);
        }
    }
}
