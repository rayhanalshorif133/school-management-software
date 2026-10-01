<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'admin@buscentral.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );

        $counters = [
            ['name' => 'Rafiqul Islam (গাবতলী কাউন্টার)', 'email' => 'gabtoli@buscentral.com', 'password' => 'gabtoli123'],
            ['name' => 'Kamal Hossain (সায়েদাবাদ কাউন্টার)', 'email' => 'sayedabad@buscentral.com', 'password' => 'sayedabad123'],
            ['name' => 'Zahid Hasan (মহাখালী কাউন্টার)', 'email' => 'mohakhali@buscentral.com', 'password' => 'mohakhali123'],
            ['name' => 'Tanvir Ahmed (উত্তরা কাউন্টার)', 'email' => 'uttara@buscentral.com', 'password' => 'uttara123'],
            ['name' => 'Nazmul Huda (চট্টগ্রাম জিইসি কাউন্টার)', 'email' => 'chittagong@buscentral.com', 'password' => 'chittagong123'],
            ['name' => 'Mahbub Alam (কক্সবাজার কাউন্টার)', 'email' => 'coxsbazar@buscentral.com', 'password' => 'coxsbazar123'],
            ['name' => 'Faruk Hossain (সিলেট কদমতলী কাউন্টার)', 'email' => 'sylhet@buscentral.com', 'password' => 'sylhet123'],
            ['name' => 'Sohail Rana (রাজশাহী রেলগেট কাউন্টার)', 'email' => 'rajshahi@buscentral.com', 'password' => 'rajshahi123'],
            ['name' => 'Anwar Parvez (বগুড়া সাতমাথা কাউন্টার)', 'email' => 'bogura@buscentral.com', 'password' => 'bogura123'],
            ['name' => 'Tariqul Islam (খুলনা সোনাডাঙ্গা কাউন্টার)', 'email' => 'khulna@buscentral.com', 'password' => 'khulna123'],
        ];

        foreach ($counters as $counter) {
            User::firstOrCreate(
                ['email' => $counter['email']],
                [
                    'name' => $counter['name'],
                    'password' => Hash::make($counter['password']),
                    'email_verified_at' => now(),
                ]
            );
        }

        $this->call(ProjectPlanSeeder::class);
    }
}
