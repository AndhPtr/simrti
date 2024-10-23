<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RiskCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('risk_categories')->insert([
            'kategori_risiko' => 'Hardware',
            'keterangan' => 'Perangkat keras yang berupa segala peralatan IT yang bersifat fisik dan nyata',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('risk_categories')->insert([
            'kategori_risiko' => 'Software',
            'keterangan' => 'Perangkat lunak yang berupa sistem operasi atau aplikasi yang bersifat non-fisik atau digital',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('risk_categories')->insert([
            'kategori_risiko' => 'Data',
            'keterangan' => 'Segala data-data dan informasi yang dimiliki oleh organisasi',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('risk_categories')->insert([
            'kategori_risiko' => 'People',
            'keterangan' => 'Orang berkepentingan yang berhubungan pada organisasi',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('risk_categories')->insert([
            'kategori_risiko' => 'Network',
            'keterangan' => 'Jaringan dan alat komunikasi dari data yang melibatkan sistem komputer',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
