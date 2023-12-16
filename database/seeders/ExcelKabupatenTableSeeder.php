<?php

namespace Database\Seeders;

use App\Models\Kabupaten;
use App\Models\Provinsi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class ExcelKabupatenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Excel::filter('chunk')->load('excel/daftar-kabupaten-kota-di-indonesia-excel.xlsx')->chunk(200, function ($results) {
            foreach ($results as $row) {
                $provinceId = Provinsi::where('provinsi', $row->province_name)->value('id');
                Kabupaten::create(['kabupaten' => $row->district_name, 'provinsi_id' => $provinceId]);
            }
        });
    }
}
