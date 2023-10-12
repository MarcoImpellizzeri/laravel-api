<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = ['HTML', 'CSS', 'JS', 'PHP', 'Vue.js', 'SASS', 'Bootstrap', 'Laravel'];
        $colors = ['#E44D26', '#2965F1', '#F0DB4F', '#787CB5', '#4FC08D', '#CC6699', '#563D7C', '#FF2D20'];

        foreach ($technologies as $index => $technology) {
            Technology::create([
                'name' => $technology,
                'color' => $colors[$index],
            ]);
        }
    }
}
