<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EquipmentCategory;

class EquipmentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Cafetière', 'image' => 'images/equipment-categories/coffee.png'],
            ['name' => 'Réfrigérateur', 'image' => 'images/equipment-categories/refrig.png'],
            ['name' => 'Ordinateur', 'image' => 'images/equipment-categories/laptop.png'],
            ['name' => 'Aspirateur traineau', 'image' => 'images/equipment-categories/vacuum.png'],
            ['name' => 'Lave-vaisselle', 'image' => 'images/equipment-categories/lave.png'],
            ['name' => 'Lave-linge', 'image' => 'images/equipment-categories/washing.png'],
            ['name' => 'Fer à repasser', 'image' => 'images/equipment-categories/iron.png'],
            ['name' => 'Grille-pain Moulinex', 'image' => 'images/equipment-categories/toaster.png'],
            ['name' => 'TV', 'image' => 'images/equipment-categories/tv.png'],
            ['name' => 'Smartphone', 'image' => 'images/equipment-categories/phone.png'],
            ['name' => 'Four', 'image' => 'images/equipment-categories/plate.png'],
        ];

        foreach ($data as $category) {
            EquipmentCategory::create($category);
        }
    }
}
