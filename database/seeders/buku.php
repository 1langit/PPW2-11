<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class buku extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Buku::factory(10)->create();
    }
}
