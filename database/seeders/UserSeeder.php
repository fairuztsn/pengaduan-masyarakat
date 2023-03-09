<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $persons = explode("|", <<<STR
        Luciana Ellison|Hallie Diaz|Cherish Sloan|Payton Nielsen|Sidney Arias|Hailie Tate|Evan Callahan|Raul Alvarez|Christine Cooke|Karen Grant|Corey Klein|Kieran Mayo|Mira Waters|Thomas Nash|Alaina Russo|Bryson Walter|Dillon Haney|Josephine Watkins|Levi Suarez|Angelo Gomez|Adyson Rodgers|Bobby Erickson|Seth Williams|Jazmyn Cohen|Raphael Benson|Corbin Jarvis|Aliyah Woodward|Jaeden Lester|Kennedi Salazar|Brielle Pace|Conrad Carey|Aiden Mcmahon|Malik Wolf|Izayah Steele|Jax Gillespie|Taniya Horton|Kamari Frost|Skylar Delacruz|Moises Key|Heaven Vargas
        STR);

        foreach($persons as $name) {
            DB::table('users')->insert([
                'nama' => $name,
                'nik' => strval(mt_rand(1111111111111111, 9999999999999999)),
                'username' => implode("", explode(" ", strtolower($name))),
                'email' => implode("", explode(" ", strtolower($name))).'@gmail.com',
                'password' => Hash::make('12345678'),
                "role_id" => 1,
                "created_at" => Carbon::now()->toDateTimeString(),
            ]);
        }
    }
}
