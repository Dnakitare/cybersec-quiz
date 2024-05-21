<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create 5 categories
        Category::factory()->count(5)->create()->each(function ($category) {
            // Create 3 quizzes for each category
            Quiz::factory()->count(3)->create(['category_id' => $category->id])->each(function ($quiz) {
                // Create 10 questions for each quiz
                Question::factory()->count(10)->create(['quiz_id' => $quiz->id]);
            });
        });
    }
}
