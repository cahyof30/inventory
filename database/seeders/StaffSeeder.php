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
            'Isna Nur Faizah',
            'Arya Wily Nur Achmad',
            'Hery Setiawan Junianto',
            'Beky Anggun Elsalibu',
            'Misbah Nur Rohman',
            'Sunu Heryanta',
            'Olivia Lungit Astari Putri',
            'Riyana Zuli Safitri',
            'Rahmanda Shevi Ulliyanti',
            'Cahyo Fitriningtyas',
            'Pristi Fadilla',
            'Almira Tsania Aflah',
            'Fajar Kurniawan',
            'Safira Nur Azizah',
            'Resti Defianti',
            'Jatu Saktia Sari',
            "Muna Fa'iqah",
            "Frisca Malosa",
            "Sri Hidayati",
            "Adenia Ayu Safira",
            "Azka Ulil Albab",
            "Sri Indah Nofita Sari",
            "Simon Prasetyanto",
            "Agus Mu'alim",
            "Nugroho Slamet",
            "Dian Tasminto",
            "Basuki Rachmat",
            "Muhammad Aswin Pratama",
        ];

        foreach ($names as $name) {
            $email = Str::of($name)
                ->lower()
                ->replace(' ', '.')
                ->append('@sgm.com');

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
