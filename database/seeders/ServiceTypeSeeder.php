<?php

namespace Database\Seeders;

use App\Models\ServiceType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServiceType::insert([
            ['id' => 1, 'name' => 'Regular Service', 'description' => 'Layanan reguler standart', 'cost' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Priority Service', 'description' => 'Layanan prioritas dengan bonus pengharum ruangan', 'cost' => 10000, 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
