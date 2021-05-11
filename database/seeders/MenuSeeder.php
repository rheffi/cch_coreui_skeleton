<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::create(
            [
           'name'=>'it',
            'parent_id'=>0,
            'manifest_name'=>'#',
            'href'=>'/#',
            'sort'=>0,
            'creator_id'=>1,
            'updater_id'=>1
        ]);
        Menu::create([
            'name'=>'메뉴',
            'parent_id'=>1,
            'manifest_name'=>'menu',
            'href'=>'/menus',
            'sort'=>0,
            'creator_id'=>1,
            'updater_id'=>1
        ]);
    }
}
