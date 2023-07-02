<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorytableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category1 = new Category;
        $category1->name = 'Minuman';
        $category1->slug = 'minuman';
        $category1->save();

        $category2 = new Category;
        $category2->name = 'Makanan';
        $category2->slug = 'makanan';
        $category2->save();
    }
}
