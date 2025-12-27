<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition(): array
    {
        return [
            'quiz_id' => Quiz::factory(),
            'text' => fake()->sentence() . '?',
            'options' => [
                'A' => fake()->sentence(),
                'B' => fake()->sentence(),
                'C' => fake()->sentence(),
                'D' => fake()->sentence(),
            ],
            'correct_answer' => fake()->randomElement(['A', 'B', 'C', 'D']),
        ];
    }
}
