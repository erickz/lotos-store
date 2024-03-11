<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Store;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Store::insert([
           'name' => 'Lotos Online'
            ,'active' => 1
            ,'alias' => 'lotosonline'
            ,'description' => 'The main enviroment of the platform'
        ]);
    }
}
