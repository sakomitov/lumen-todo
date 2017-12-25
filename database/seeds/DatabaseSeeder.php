<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Note;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model as Eloquent;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        User::truncate();
        Note::truncate();



        //factory(Note::class, 20);


        $this->call('UsersTableSeeder');
        $this->call('NotesTableSeeder');
    }
}
