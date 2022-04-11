<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insertOrIgnore([
            [
                'id' => 1,
                'name' => 'create product'
            ],
            [
                'id' => 2,
                'name' => 'edit product'
            ],
            [
                'id' => 3,
                'name' => 'delete product'
            ],
            [
                'id' => 4,
                'name' => 'dispatch product'
            ],
            [
                'id' => 5,
                'name' => 'distribute product'
            ],
            [
                'id' => 6,
                'name' => 'give permissions'
            ],
        ]);
    }
}
