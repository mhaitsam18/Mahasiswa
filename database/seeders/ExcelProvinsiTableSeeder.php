<?php

namespace Database\Seeders;

use App\Models\Provinsi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class ExcelProvinsiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Excel::filter('chunk')->load('excel/daftar-kabupaten-kota-di-indonesia-excel.xlsx')->chunk(200, function ($results) {
            foreach ($results as $row) {
                Provinsi::create(['name' => $row->province_name]);
            }
        });
    }
}
