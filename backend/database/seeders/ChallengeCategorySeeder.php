<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChallengeCategory;

class ChallengeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Réparer',
                'image' => 'images/challenge-categories/reparation.png',
                'image_checked' => 'images/challenge-categories/reparation-w.png',
                'color' => '#007E77'
            ],
            [
                'name' => 'Consommer',
                'image' => 'images/challenge-categories/recyclage.png',
                'image_checked' => 'images/challenge-categories/recyclage-w.png',
                'color' => '#FF8552'
            ],
            [
                'name' => 'Renouveler',
                'image' => 'images/challenge-categories/renouvellement.png',
                'image_checked' => 'images/challenge-categories/renouvellement-w.png',
                'color' => '#23F1A7'
            ],
            [
                'name' => 'Entretenir',
                'image' => 'images/challenge-categories/entretien.png',
                'image_checked' => 'images/challenge-categories/entretien-w.png',
                'color' => '#003459'
            ]
        ];

        foreach ($data as $category) {
            ChallengeCategory::create($category);
        }
    }
}
