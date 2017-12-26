<?php

use App\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;


class UsersTableSeeder extends Seeder {

	public function run()

	{
		$faker = Faker::create();

		foreach(range(1,10) as $index) {
			User::create([
				'username' => $faker->uuid(),
				'password' => $faker->password(),
				'api_token' =>substr($faker->sha256(),0,32)]);
		}

	}
}

