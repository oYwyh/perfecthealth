<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Admin::factory(10)->create();
        // \App\Models\Doctor::factory(10)->create();
        // \App\Models\User::factory(10)->create();

        \App\Models\Admin::factory()->create([
            'name' => 'admin',
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@perfect-health.net',
            'date_of_brith'=>'2008-08-12',
            'gender'=>'male',
            'phone'=>'20080812',
            'password'=>'mssa16771',
            'facebook'=>'https://www.facebook.com/lol/',
            'instagram'=>'https://www.instagram.com/lol/',
            'twitter'=>'https://www.twitter.com/lol/',
            'linkedin'=>'https://www.linkedin.com/in/lol/',
            'superadmin' => '1',
            'image'=>'images/profiles/default.jpg',
        ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'YWYH',
        //     'first_name' => 'Yassien',
        //     'last_name' => 'Waleed',
        //     'email' => 'yassienwyh0@gmail.com',
        //     'password'=>'YWYH',
        //     'gender'=>'male',
        //     'phone'=>'01558854716',
        //     'national_id'=>'01558854716',
        //     'verification_code'=>'685987',
        //     'verified'=>'1',
        //     'image'=>'images/profiles/doctors/1692640061.png',
        // ]);
        // \App\Models\Doctor::factory()->create([
        //     'name' => 'Waldmed',
        //     'first_name' => 'waleed',
        //     'last_name' => 'haikal',
        //     'email' => 'waldmed@gmail.com',
        //     'password'=>'waldmed',
        //     'date_of_brith'=>'2023-09-20',
        //     'specialty'=>'surgery',
        //     'phone'=>'01024824716',
        //     'national_id' =>'01024824716',
        //     'gender'=>'male',
        //     'days'=>'monday',
        //     'hours'=>'monday_10-11',
        //     'image'=>'images/profiles/doctors/1692640061.png',
        //     'hours'=>'monday_10-11',
        // ]);
        // \App\Models\Receptionist::factory()->create([
        //     'name' => 'lol',
        //     'first_name' => 'lol',
        //     'last_name' => 'lol',
        //     'email' => 'lol@gmail.com',
        //     'password'=>'lol',
        //     'phone'=>'20230920',
        //     'national_id'=>'20230920',
        //     'gender'=>'male',
        //     'date_of_brith'=>'2023-09-20',
        //     'image'=>'images/profiles/default.jpg',
        // ]);
    }
}
