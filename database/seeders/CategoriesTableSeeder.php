<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Sistema nervoso',
            'Apparato respiratorio',
            'Apparato cardiocircolatorio',
            'Apparato digerente',
            'Epatobiliari e pancreas',
            'Rene e vie urinarie',
            'Pelle e sottocutaneo',
            'Sangue e organi ematopoietici',
            'Infettive e parassitarie',
            'Traumatismi e ustioni',
        ];

        foreach ($categories as $category) {
            $newCategory = new Category();
            $newCategory->category = $category;
            $newCategory->save();
        }
    }
}

// php artisan db:seed CategoriesTableSeeder