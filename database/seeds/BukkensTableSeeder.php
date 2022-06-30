<?php

use Illuminate\Database\Seeder;

class BukkensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bukkens')->insert([
            'estate_id' => '1',
            'kinds' => 'マンション',
            'name' => 'テスト物件01',
            'address' => 'テスト県テスト市テスト町',
            'rent' => '5万',
            'management_fee' => '5000',
            'floor' => '5階',
            'floor_plan' => '1LDK', 
            'nearest_station' => 'テスト線テスト駅',
            'age' => '5年', 
        ]);
        DB::table('bukkens')->insert([
            'estate_id' => '1',
            'kinds' => 'アパート',
            'name' => 'テスト物件02',
            'address' => 'テスト県テスト市テスト町',
            'rent' => '5万',
            'management_fee' => '5000',
            'floor' => '5階',
            'floor_plan' => '1LDK', 
            'nearest_station' => 'テスト線テスト駅',
            'age' => '5年', 
        ]);
        DB::table('bukkens')->insert([
            'estate_id' => '1',
            'kinds' => '戸建て',
            'name' => 'テスト物件03',
            'address' => 'テスト県テスト市テスト町',
            'rent' => '5万',
            'management_fee' => '5000',
            'floor' => '5階',
            'floor_plan' => '1LDK', 
            'nearest_station' => 'テスト線テスト駅',
            'age' => '5年', 
        ]);
    }
}
