<?php

use App\Note;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class NotesTableSeeder extends Seeder {

    public function run() {

        $faker = Faker::create();

        foreach(range(1,10) as $index) {
            Note::create([
                'title' => $faker->word,
                'description' => $faker->sentence(6),
                'completed' => $faker->boolean(0),
                'user_id' => $faker->numberBetween(1,10),
            ]);

        }
    }
}