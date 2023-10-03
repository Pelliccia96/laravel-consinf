<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            'Chirurgico generale e Specialistico',
            'Cardio-Toracico-Vascolare',
            'Testa-collo',
            'Diagnostico',
            'Medicina generale e specialistica',
            'Materno Infantile',
            'Medico Geriatrico Riabilitativo',
            'Interaziendale Emergenza-Urgenza',
        ];

        foreach ($departments as $department) {
            $newDepartment = new Department();
            $newDepartment->department = $department;
            $newDepartment->save();
        }
    }
}

// php artisan db:seed DepartmentsTableSeeder