<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insertOrIgnore([
            [
                'id' => 1,
                'name' => 'Administrator'
            ],
            [
                'id' => 2,
                'name' => 'Manager'
            ],
            [
                'id' => 3,
                'name' => 'Tailor'
            ],
            [
                'id' => 4,
                'name' => 'Dispatcher'
            ],
            [
                'id' => 5,
                'name' => 'Distributor'
            ],
        ]);
    }
}
