<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\GardenTool;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Istator',
            'email' => 'admin@ncob.com',
            'role' => 'admin',
            'password' => Hash::make('password')
        ]);

        User::create([
            'first_name' => 'Dave',
            'last_name' => 'Loper',
            'email' => 'dave.loper@ncob.com',
            'role' => 'user',
            'password' => Hash::make('password')
        ]);

        GardenTool::create([
            'name'=> 'Back Scratcher',
            'description' => '+25% damage bonus +50% health from packs on wearer -75% health from healers on wearer',
            'price' => 5000,
            'image' => '/assets/media/gardentools/def_back_scratcher.png',
            'stock' => random_int(20, 30)
        ]);

        GardenTool::create([
            'name'=> 'Stock Shovel',
            'description' => 'A stock shovel from Tea For 2!',
            'price' => 500,
            'image' => '/assets/media/gardentools/def_stock_shovel.png',
            'stock' => random_int(100, 500)
        ]);

        GardenTool::create([
            'name'=> 'Market Gardener',
            'description' => 'Deals crits while the wielder is rocket jumping. 20% slower firing speed. No random critical hits.',
            'price' => 4500,
            'image' => '/assets/media/gardentools/def_market_gardener.png',
            'stock' => random_int(1, 10)
        ]);

        GardenTool::create([
            'name'=> 'Kőműves Taliga',
            'description' => 'Öreg megbízható taliga',
            'price' => 69420,
            'image' => '/assets/media/gardentools/def_talicska.png',
            'stock' => 0
        ]);

        GardenTool::create([
            'name'=> 'HUSQVARNA LC 419SP',
            'description' => 'A very decent lawn mower.',
            'price' => 249500,
            'image' => '/assets/media/gardentools/def_lawn_mower.png',
            'stock' => 22
        ]);

        GardenTool::create([
            'name'=> 'Stihl Láncfűrész',
            'description' => 'Stihl láncfűrész',
            'price' => 250000,
            'image' => '/assets/media/gardentools/def_stihl_lancfuresz.png',
            'stock' => random_int(0, 35)
        ]);

        for ($i=0; $i < 3; $i++) {
            GardenTool::create([
                'name' => 'Villáskapa #'.$i,
                'description' => 'This is the desc. of Villáskapa #'.$i,
                'price' => round(random_int(30000, 50000), -1),
                'image' => '/assets/media/gardentools/def_villaskapa.png',
                'stock' => random_int(5, 15)
            ]);
        }
    }
}
