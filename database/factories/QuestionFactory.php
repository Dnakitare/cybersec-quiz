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

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quiz_id' => Quiz::factory(),
            'text' => $this->faker->sentence,
            'options' => $this->faker->randomElements([
                'Option 1', 'Option 2', 'Option 3', 'Option 4',
            ], 4),
            'correct_answer' => $this->faker->randomElement([
                'Option 1', 'Option 2', 'Option 3', 'Option 4',
            ], 4),
        ];
    }
}
