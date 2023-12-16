<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Annonce;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {



        for($i=0;$i<5;$i++){
            $annonce=new Annonce();
            $annonce->titre="titre".$i;
            $annonce->description="description".$i;
            $annonce->user_id=1;
            $annonce->location="ariana";
            $annonce->categorie="categorie".$i;
            $annonce->price="100".$i;
            $annonce->save();
        }
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
