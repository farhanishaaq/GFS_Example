<?php

namespace Database\Seeders;

use App\Models\chunk;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        chunk::create([
                'system_name'=>'CHUNK_IP_S_1',
                'total_memory'=>256,
                 'used_memory'=>null,
                'remaining_memory'=>256
        ]);  chunk::create([
                'system_name'=>'CHUNK_IP_S_2',
                'total_memory'=>512,
                 'used_memory'=>null,
                'remaining_memory'=>512

        ]);
    }
}
