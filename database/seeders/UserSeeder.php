<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'name'=>'관리자',
                'code'=>'dev0001',
                'password'=>Hash::make('1234'),
                'creator_id'=>1,
                'updater_id'=>1
            ]);
    }
}
