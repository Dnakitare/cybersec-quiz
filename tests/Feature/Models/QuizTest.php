<?php

use App\Models\Category;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('quiz belongs to a category', function () {
    $category = Category::factory()->create();
    $quiz = Quiz::factory()->create(['category_id' => $category->id]);

    expect($quiz->category)->toBeInstanceOf(Category::class);
    expect($quiz->category->id)->toBe($category->id);
});

test('quiz has many questions', function () {
    $quiz = Quiz::factory()->create();
    Question::factory()->count(3)->create(['quiz_id' => $quiz->id]);

    expect($quiz->questions)->toHaveCount(3);
    expect($quiz->questions->first())->toBeInstanceOf(Question::class);
});

test('quiz can be created with required attributes', function () {
    $category = Category::factory()->create();

    $quiz = Quiz::create([
        'title' => 'Test Quiz',
        'category_id' => $category->id,
    ]);

    expect($quiz)->toBeInstanceOf(Quiz::class);
    expect($quiz->title)->toBe('Test Quiz');
    expect($quiz->category_id)->toBe($category->id);
});

test('deleting quiz cascades to questions', function () {
    $quiz = Quiz::factory()->create();
    Question::factory()->count(3)->create(['quiz_id' => $quiz->id]);

    expect(Question::where('quiz_id', $quiz->id)->count())->toBe(3);

    $quiz->delete();

    expect(Question::where('quiz_id', $quiz->id)->count())->toBe(0);
});
