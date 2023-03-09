<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::insert('insert into users (nik, email, nama, username, password, role_id) values (?, ?, ?, ?, ?, ?)', [
            '123456782', 'hewhoremains@gmail.com', 'Nataniel Richards', 'hewhoremains', Hash::make('12345678'), 3
        ]);
    }
}
