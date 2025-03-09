<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->truncate(); 

        $categories = ['Elektronik', 'Pakaian', 'Makanan', 'Minuman', 'Alat Tulis'];
        
        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category]);
        }
    }
}


