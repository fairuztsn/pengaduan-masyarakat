<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

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
        $persons = explode("|", <<<STR
        Kemal Fairuz|Kanahaya Raditya|Zhahiran Fajri|Abdurrahman Iqbal|Qinthara Dhafin|Fikri Farras|Jiwani Favian|Slamet Arsyl|Bayu Andhika
        STR);
        
        for($i = 0; $i < count($persons); $i ++) {
            DB::table("users")->insert([
                'nama' => $persons[$i],
                    'nik' => strval(mt_rand(1111111111111111, 9999999999999999)),
                    'username' => implode("", explode(" ", strtolower($persons[$i]))),
                    'email' => implode("", explode(" ", strtolower($persons[$i]))).'@gmail.com',
                    'password' => Hash::make('12345678'),
                    "role_id" => $i < 3 ? 3 : 2,
                    "created_at" => Carbon::now()->toDateTimeString(),
            ]);
        }
    }
}
