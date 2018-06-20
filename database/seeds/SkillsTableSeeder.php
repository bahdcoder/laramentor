<?php

use App\Skill;
use Illuminate\Database\Seeder;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Skill::create([
            'name'  => 'laravel',
            'color' => '#000',
        ]);

        Skill::create([
            'name'  => 'vuejs',
            'color' => '#000',
        ]);

        Skill::create([
            'name'  => 'reactjs',
            'color' => '#000',
        ]);

        Skill::create([
            'name'  => 'eloquent',
            'color' => '#000',
        ]);

        Skill::create([
            'name'  => 'laravel-cashier',
            'color' => '#000',
        ]);
    }
}
