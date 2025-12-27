<?php

namespace Database\Seeders;

// use App\Models\Category;
// use App\Models\Question;
// use App\Models\Quiz;
// use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // // User::factory(10)->create();
        //
        // // Create a default test user if needed (comment out if causing conflicts or unwanted)
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        //
        // // Create dummy categories, quizzes, and questions using factories (comment out if using specific seeders)
        // Category::factory()->count(2)->create()->each(function ($category) {
        //     // Create quizzes for each category
        //     Quiz::factory()->count(1)->create(['category_id' => $category->id])->each(function ($quiz) {
        //         // Create questions for each quiz
        //         Question::factory()->count(5)->create(['quiz_id' => $quiz->id]);
        //     });
        // });

        // Call specific seeders
        $this->call([
            AdminUserSeeder::class,
            CybersecurityQuizSeeder::class,
        ]);
    }
}
