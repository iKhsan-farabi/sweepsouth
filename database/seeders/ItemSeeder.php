<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::insert([
            ['name' => 'Bersihkan Ruangan', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bersihkan Toilet', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Poles Lantai', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Disinfektan', 'created_at' => now(), 'updated_at' => now()]


        ]);
    }
}
