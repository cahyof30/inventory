<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'Isna',
            'Wily',
            'Nurrul',
            'Galih',
            'Hery',
            'Beky Anggun',
            'Danang S',
            'Rusak',
            'Misbah',
            'Fat',
            'Sunu',
            'Olivia',
            'Riyana',
            'Rahmanda',
            'Cahyo',
            'Adieb',
            'Lala',
            'Almira',
            'Fajar',
            'Fira',
            'Satria',
        ];

        foreach ($names as $name) {
            $email = Str::of($name)
                ->lower()
                ->replace(' ', '.')
                ->append('@gmail.com');

            User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'password' => null,
                    'role' => 'staf',
                ]
            );
        }
    }
}
