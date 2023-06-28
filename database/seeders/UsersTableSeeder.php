<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            //admin account
                [
                    'name' => 'janica',
                    'email' => 'janica@gmail.com',
                    'password' => Hash::make('111'),
                    'photo' => 'admin/janica.jpg',
                    'role' => 'admin'
                ],
                
            //end of admin account

            //judge account
                [
                    'name' => 'beverly',
                    'email' => 'beverly@gmail.com',
                    'password' => Hash::make('111'),
                    'photo' => 'judges/beverly.jpg',
                    'role' => 'judge'
                ],

                [
                    'name' => 'hussien',
                    'email' => 'hussien@gmail.com',
                    'password' => Hash::make('111'),
                    'photo' => 'judges/hussien.jpg',
                    'role' => 'judge'
                ],

                [
                    'name' => 'jimmy',
                    'email' => 'jimmy@gmail.com',
                    'password' => Hash::make('111'),
                    'photo' => 'judges/jimmy.jpg',
                    'role' => 'judge'
                ],
            //end of judge account

            //contestant accounts
                [
                    'name' => 'milane batan',
                    'email' => 'milane@gmail.com',
                    'password' => Hash::make('111'),
                    'photo' => 'contestants/love.jpg',
                    'role' => 'contestant'
                ],
                [
                    'name' => 'ariana grande',
                    'email' => 'ariana@gmail.com',
                    'password' => Hash::make('111'),
                    'photo' => 'contestants/c1.jpg',
                    'role' => 'contestant'
                ],
                [
                    'name' => 'maria clara',
                    'email' => 'maria@gmail.com',
                    'password' => Hash::make('111'),
                    'photo' => 'contestants/c2.jpg',
                    'role' => 'contestant'
                ],
            //end of contestant account

            //user account
                [
                    'name' => 'alex',
                    'email' => 'alex@gmail.com',
                    'password' => Hash::make('111'),
                    'photo' => 'users/u1.jpg',
                    'role' => 'user'
                ],
                [
                    'name' => 'sarah',
                    'email' => 'sarah@gmail.com',
                    'password' => Hash::make('111'),
                    'photo' => 'users/u2.jpg',
                    'role' => 'user'
                ],
                [
                    'name' => 'juliana',
                    'email' => 'juliana@gmail.com',
                    'password' => Hash::make('111'),
                    'photo' => 'users/u3.jpg',
                    'role' => 'user'
                ],
            //end of user account

        ]); 
    }
}
