<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Roles;
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
        //
        DB::insert('insert into roles (id, name) values (?, ?)', [1, 'User']);
        DB::insert('insert into roles (id, name) values (?, ?)', [2, 'Petugas']);
        DB::insert('insert into roles (id, name) values (?, ?)', [3, 'Admin']);
    }
}
