<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FamiliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $familes = [        
        ['number_of_children' => 1, 'relationship' => 'married', 'dual_income' => true],
        ['number_of_children' => 1, 'relationship' => 'married', 'dual_income' => false],
        ['number_of_children' => 2, 'relationship' => 'married', 'dual_income' => true],
        ['number_of_children' => 2, 'relationship' => 'married', 'dual_income' => false],
        ['number_of_children' => 3, 'relationship' => 'married', 'dual_income' => true],
        ['number_of_children' => 3, 'relationship' => 'married', 'dual_income' => false],
        ['number_of_children' => 4, 'relationship' => 'married', 'dual_income' => true],
        ['number_of_children' => 4, 'relationship' => 'married', 'dual_income' => false],
        ['number_of_children' => 5, 'relationship' => 'married', 'dual_income' => true],
        ['number_of_children' => 5, 'relationship' => 'married', 'dual_income' => false],
        ['number_of_children' => 6, 'relationship' => 'married', 'dual_income' => true],
        ['number_of_children' => 6, 'relationship' => 'married', 'dual_income' => false],
        ['number_of_children' => 7, 'relationship' => 'married', 'dual_income' => true],
        ['number_of_children' => 7, 'relationship' => 'married', 'dual_income' => false],
        ['number_of_children' => 8, 'relationship' => 'married', 'dual_income' => true],
        ['number_of_children' => 8, 'relationship' => 'married', 'dual_income' => false],
        ['number_of_children' => 9, 'relationship' => 'married', 'dual_income' => true],
        ['number_of_children' => 9, 'relationship' => 'married', 'dual_income' => false],
        ['number_of_children' => 10, 'relationship' => 'married', 'dual_income' => true],
        ['number_of_children' => 10, 'relationship' => 'married', 'dual_income' => false],
        ['number_of_children' => 1, 'relationship' => 'single_parent', 'dual_income' => true],
        ['number_of_children' => 1, 'relationship' => 'single_parent', 'dual_income' => false],
        ['number_of_children' => 2, 'relationship' => 'single_parent', 'dual_income' => true],
        ['number_of_children' => 2, 'relationship' => 'single_parent', 'dual_income' => false],
        ['number_of_children' => 3, 'relationship' => 'single_parent', 'dual_income' => true],
        ['number_of_children' => 3, 'relationship' => 'single_parent', 'dual_income' => false],
        ['number_of_children' => 4, 'relationship' => 'single_parent', 'dual_income' => true],
        ['number_of_children' => 4, 'relationship' => 'single_parent', 'dual_income' => false],
        ['number_of_children' => 5, 'relationship' => 'single_parent', 'dual_income' => true],
        ['number_of_children' => 5, 'relationship' => 'single_parent', 'dual_income' => false],
        ['number_of_children' => 6, 'relationship' => 'single_parent', 'dual_income' => true],
        ['number_of_children' => 6, 'relationship' => 'single_parent', 'dual_income' => false],
        ['number_of_children' => 7, 'relationship' => 'single_parent', 'dual_income' => true],
        ['number_of_children' => 7, 'relationship' => 'single_parent', 'dual_income' => false],
        ['number_of_children' => 8, 'relationship' => 'single_parent', 'dual_income' => true],
        ['number_of_children' => 8, 'relationship' => 'single_parent', 'dual_income' => false],
        ['number_of_children' => 9, 'relationship' => 'single_parent', 'dual_income' => true],
        ['number_of_children' => 9, 'relationship' => 'single_parent', 'dual_income' => false],
        ['number_of_children' => 10, 'relationship' => 'single_parent', 'dual_income' => true],
        ['number_of_children' => 10, 'relationship' => 'single_parent', 'dual_income' => false],
        
    ];

    foreach ($familes as $family) {
        \App\Models\Family::create($family);
    }
    }
}
