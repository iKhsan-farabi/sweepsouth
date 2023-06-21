<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::insert([
            ['name' => 'Rumah sedang', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kantor sedang', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rumah besar', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kantor besar', 'created_at' => now(), 'updated_at' => now()]

        ]);
    }
}
