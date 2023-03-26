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
        $laporan = <<<HTML
        <div class="p"><em>Yth. Bapak Kapolsek Bantul</em></div>
        <div class="p"><em>Di Yogyakarta</em></div>
        <div class="p"><em>Hal: Laporan Penipuan Online</em></div>
        <div class="p"><em>Lampiran: 1 (satu) halaman</em></div>
        <div class="p"><em>Dengan hormat,</em></div>
        <div class="p"><em>Saya yang bertanda tangan di bawah ini:</em></div>
        <div class="p"><em>Nama : Bayu</em></div>
        <div class="p"><em>Jenis Kelamin : Laki-laki</em></div>
        <div class="p"><em>No KTP : 123456778</em></div>
        <div class="p"><em>Alamat : Jl. Kasongan no. 20</em></div>
        <div class="p"><em>No. Telp : 0274 98899</em></div>
        <div class="p"><em>Saudara Risma telah melakukan tindakan penipuan berupa penjualan barang secara online melalui Instagram senial Rp. 5.000.000,-. Barang yang diterima tidak sesuai pesanan, cacat dan tidak original. Pihak penjual menjanjikan untuk mengembalikan uang dalam waktu seminggu. Akan tetapi, uang tersebut belum juga dikembalikan hingga saat ini, terhitung 3 minggu dari barang diterima.</em></div>
        <div class="p"><em>Pihak yang bersangkutan belum menunjukkan itikad baik mengembalikan uang tersebut.</em></div>
        <div class="p"><em>Sebagai bukti, saya lampirkan nota pembelian barang dengan bukti chat kepada penjual. Di mana chat tersebut menjelaskan bahwa penjual akan mengembalikan uang paling lambat satu minggu setelah barang diterima.</em></div>
        <div class="p"><em>Demikian pengaduan ini saya buat. Besar harapan saya agar pihak kepolisian dapat menyelesaikan perkara ini hingga tuntas. Atas perhatian Bapak, saya ucapkan terima kasih.</em></div>
        <div class="p"><em>Yogyakarta, 01 Maret 2021</em></div>
        <div class="p"><em>Hormat saya,</em></div>
        <div class="p"><em>Bayu</em></div>
        <div class="p"><em>Pelapor</em></div>
        HTML;
        
        $query = <<<SQL
        INSERT INTO `laporan` (`id`, `judul`, `tanggal_kejadian`, `id_user`, `isi`, `foto`, `status`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);
        SQL;

        $value = [NULL, 'jalan rusak', '2023-02-17', '49', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo placeat tenetur veniam eaque inventore dolores nam. Quod natus architecto quidem qui. Voluptatibus praesentium deserunt sit nam aliquam blanditiis similique voluptates earum voluptatum saepe asperiores id omnis iure, quasi nisi alias! Eius, veritatis! Quisquam, animi dicta minima ex eligendi architecto laudantium!', 'test.jpg', '0', NULL, NULL];

        DB::insert($query, $value);
    }
}
