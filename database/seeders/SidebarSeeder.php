<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SidebarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('sidebars')->insertOrIgnore([
            [
                'id' => 1,
                'title' => 'Dashboard',
                'path_one' => 'M2 10C2 5.58172 5.58172 2 10 2V10H18C18 14.4183 14.4183 18 10 18C5.58172 18 2 14.4183 2 10Z',
                'path_two' => 'M12 2.25195C14.8113 2.97552 17.0245 5.18877 17.748 8.00004H12V2.25195Z'
            ],
            [
                'id' => 2,
                'title' => 'Products',
                'path_one' => 'M17 8h1v11H2V8h1V6c0-2.76 2.24-5 5-5c.71 0 1.39.15 2 .42A4.94 4.94 0 0 1 12 1c2.76 0 5 2.24 5 5v2zM5 6v2h2V6c0-1.13.39-2.16 1.02-3H8C6.35 3 5 4.35 5 6zm10 2V6c0-1.65-1.35-3-3-3h-.02A4.98 4.98 0 0 1 13 6v2h2zm-5-4.22C9.39 4.33 9 5.12 9 6v2h2V6c0-.88-.39-1.67-1-2.22z',
                'path_two' => ''
            ],
            [
                'id' => 3,
                'title' => 'Orders',
                'path_one' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                'path_two' => ''
            ],
            [
                'id' => 4,
                'title' => 'Users',
                'path_one' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
                'path_two' => ''
            ]
            
        ]);
    }
}
