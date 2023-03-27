<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\PHP;

use Illuminate\Support\Carbon;

use App\Models\User;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private function laporan(User $user): string {
        $date = Carbon::parse($user->created_at)->toDateString();
        return <<<HTML
        <div class="p"><em>Yth. Petugas Laporin</em></div>
        <div class="p"><em>Di Bandung, Jawa Barat</em></div>
        <div class="p"><em>Hal: Laporan Penipuan Online</em></div>
        <div class="p"><em>Lampiran: 1 (satu) halaman</em></div>
        <div class="p"><em>Dengan hormat,</em></div>
        <div class="p"><em>Saya yang bertanda tangan di bawah ini:</em></div>
        <div class="p"><em>Nama : $user->nama</em></div>
        <div class="p"><em>NIK : $user->nik</em></div>
        <div class="p"><em>Alamat Email: $user->email</em></div>
        <div class="p"><em>Saudara Risma telah melakukan tindakan penipuan berupa penjualan barang secara online melalui Instagram senial Rp. 5.000.000,-. Barang yang diterima tidak sesuai pesanan, cacat dan tidak original. Pihak penjual menjanjikan untuk mengembalikan uang dalam waktu seminggu. Akan tetapi, uang tersebut belum juga dikembalikan hingga saat ini, terhitung 3 minggu dari barang diterima.</em></div>
        <div class="p"><em>Pihak yang bersangkutan belum menunjukkan itikad baik mengembalikan uang tersebut.</em></div>
        <div class="p"><em>Sebagai bukti, saya lampirkan nota pembelian barang dengan bukti chat kepada penjual. Di mana chat tersebut menjelaskan bahwa penjual akan mengembalikan uang paling lambat satu minggu setelah barang diterima.</em></div>
        <div class="p"><em>Demikian pengaduan ini saya buat. Besar harapan saya agar pihak kepolisian dapat menyelesaikan perkara ini hingga tuntas. Atas perhatiannya, saya ucapkan terima kasih.</em></div>
        <div class="p"><em>Bandung, $date</em></div>
        <div class="p"><em>Hormat saya,</em></div>
        <div class="p"><em>$user->nama</em></div>
        <div class="p"><em>Pelapor</em></div>
        HTML;
    }

    private function insertIntoLaporan($value): void {
        $query = <<<SQL
        INSERT INTO `laporan` (`id`, `judul`, `tanggal_kejadian`, `id_user`, `isi`, `foto`, `status`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);
        SQL;

        DB::insert($query, $value);
    }

    public function run()
    {
        // Must php artisan db:seed --class=UserSeeder first

        for($id = 40; $id < 50; $id ++) {
            $user = User::find($id);
            $laporan = $this->laporan(User::find($id));
            $value = [NULL, 'Penipuan Online', Carbon::parse($user->created_at)->toDateString(), $id, $laporan, 'default.png', '0', now(), NULL];
            $this->insertIntoLaporan($value);
        }
    }
}
