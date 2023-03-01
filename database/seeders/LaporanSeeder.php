<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\PHP;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $query = <<<SQL
        INSERT INTO `pengaduan` (`id`, `tanggal_pengaduan`, `id_user`, `isi_laporan`, `foto`, `status`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?, ?, ?, ?, ?);
        SQL;

        $value = [NULL, '2023-02-17', '1', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo placeat tenetur veniam eaque inventore dolores nam. Quod natus architecto quidem qui. Voluptatibus praesentium deserunt sit nam aliquam blanditiis similique voluptates earum voluptatum saepe asperiores id omnis iure, quasi nisi alias! Eius, veritatis! Quisquam, animi dicta minima ex eligendi architecto laudantium!', 'test.jpg', '0', NULL, NULL];

        DB::insert($query, $value);
    }
}
