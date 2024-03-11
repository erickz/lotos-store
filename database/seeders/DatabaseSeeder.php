<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // $this->call(StoreSeeder::class);
        $this->call(LaratrustSeeder::class);
        $this->call(PricingPermissionsSeeder::class);
        $this->call(StorePermissionsSeeder::class);
        $this->call(BoloesPermissionsSeeder::class);
        $this->call(ConcursosPermissionsSeeder::class);
        $this->call(CustomersPermissionsSeeder::class);
        $this->call(LoteriesPermissionsSeeder::class);
        $this->call(LoteriesSeeder::class);
        $this->call(LoteriesCostsSeeder::class);
        
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
