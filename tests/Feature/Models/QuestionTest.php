<?php

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('question belongs to a quiz', function () {
    $quiz = Quiz::factory()->create();
    $question = Question::factory()->create(['quiz_id' => $quiz->id]);

    expect($question->quiz)->toBeInstanceOf(Quiz::class);
    expect($question->quiz->id)->toBe($quiz->id);
});

test('question options are cast to array', function () {
    $question = Question::factory()->create([
        'options' => [
            'A' => 'Option A',
            'B' => 'Option B',
            'C' => 'Option C',
            'D' => 'Option D',
        ],
    ]);

    expect($question->options)->toBeArray();
    expect($question->options)->toHaveKeys(['A', 'B', 'C', 'D']);
});

test('question can be created with valid data', function () {
    $quiz = Quiz::factory()->create();

    $question = Question::create([
        'quiz_id' => $quiz->id,
        'text' => 'What is 2 + 2?',
        'options' => [
            'A' => '3',
            'B' => '4',
            'C' => '5',
            'D' => '6',
        ],
        'correct_answer' => 'B',
    ]);

    expect($question->text)->toBe('What is 2 + 2?');
    expect($question->correct_answer)->toBe('B');
    expect($question->options['B'])->toBe('4');
});

test('correct answer must be a valid option key', function () {
    $question = Question::factory()->create([
        'options' => [
            'A' => 'Option A',
            'B' => 'Option B',
        ],
        'correct_answer' => 'A',
    ]);

    expect(array_key_exists($question->correct_answer, $question->options))->toBeTrue();
});
