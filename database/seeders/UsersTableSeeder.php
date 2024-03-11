<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::insert([
            'name'  => 'admin'
            ,'store_id' => null
            ,'email' => 'erickcmiguel@gmail.com'
            ,'email_verified_at' => now()
            ,'password' => bcrypt('teste@123')
            ,'api_token' => Str::random(10)
            ,'remember_token' => Str::random(10)
            ,'created_at' => now()
            ,'updated_at' => now()
        ]);
    }
}
