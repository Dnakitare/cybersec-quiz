<?php

use App\Models\Category;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Result;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use App\Livewire\QuizTakingComponent;

uses(RefreshDatabase::class);

test('guests cannot access quiz taking page', function () {
    $quiz = Quiz::factory()->create();

    $response = $this->get("/quizzes/{$quiz->id}");

    $response->assertRedirect('/login');
});

test('authenticated users can access quiz taking page', function () {
    $user = User::factory()->create();
    $quiz = Quiz::factory()->create();
    Question::factory()->count(3)->create(['quiz_id' => $quiz->id]);

    $response = $this->actingAs($user)->get("/quizzes/{$quiz->id}");

    $response->assertOk();
    $response->assertSeeLivewire('quiz-taking-component');
});

test('quiz taking page shows quiz title', function () {
    $user = User::factory()->create();
    $quiz = Quiz::factory()->create(['title' => 'Security Awareness Quiz']);
    Question::factory()->count(3)->create(['quiz_id' => $quiz->id]);

    $response = $this->actingAs($user)->get("/quizzes/{$quiz->id}");

    $response->assertSee('Security Awareness Quiz');
});

test('users can submit quiz and see score', function () {
    $user = User::factory()->create();
    $quiz = Quiz::factory()->create();
    $question1 = Question::factory()->create([
        'quiz_id' => $quiz->id,
        'correct_answer' => 'A',
    ]);
    $question2 = Question::factory()->create([
        'quiz_id' => $quiz->id,
        'correct_answer' => 'B',
    ]);

    Livewire::actingAs($user)
        ->test(QuizTakingComponent::class, ['quiz' => $quiz])
        ->set("answers.{$question1->id}", 'A')  // Correct
        ->set("answers.{$question2->id}", 'A')  // Wrong
        ->call('submitQuiz')
        ->assertRedirect(route('dashboard'));

    // Check result was saved
    $result = Result::where('user_id', $user->id)
        ->where('quiz_id', $quiz->id)
        ->first();

    expect($result)->not->toBeNull();
    expect($result->score)->toBe(1);
});

test('users cannot retake quiz they already completed', function () {
    $user = User::factory()->create();
    $quiz = Quiz::factory()->create();
    Question::factory()->create(['quiz_id' => $quiz->id]);

    // Create existing result
    Result::create([
        'user_id' => $user->id,
        'quiz_id' => $quiz->id,
        'score' => 1,
    ]);

    $response = $this->actingAs($user)->get("/quizzes/{$quiz->id}");

    $response->assertRedirect(route('dashboard'));
    $response->assertSessionHas('error');
});

test('quiz score is calculated correctly', function () {
    $user = User::factory()->create();
    $quiz = Quiz::factory()->create();

    // Create 5 questions, all with correct answer 'A'
    $questions = Question::factory()->count(5)->create([
        'quiz_id' => $quiz->id,
        'correct_answer' => 'A',
    ]);

    $answers = [];
    foreach ($questions as $index => $question) {
        // Answer 3 correctly (A), 2 incorrectly (B)
        $answers[$question->id] = $index < 3 ? 'A' : 'B';
    }

    Livewire::actingAs($user)
        ->test(QuizTakingComponent::class, ['quiz' => $quiz])
        ->set('answers', $answers)
        ->call('submitQuiz');

    $result = Result::where('user_id', $user->id)
        ->where('quiz_id', $quiz->id)
        ->first();

    expect($result->score)->toBe(3);
});

test('user dashboard shows quiz results', function () {
    $user = User::factory()->create();
    $quiz = Quiz::factory()
        ->has(Question::factory()->count(5))
        ->create(['title' => 'Completed Quiz']);

    Result::create([
        'user_id' => $user->id,
        'quiz_id' => $quiz->id,
        'score' => 4,
    ]);

    $response = $this->actingAs($user)->get('/dashboard');

    $response->assertOk();
    $response->assertSee('Completed Quiz');
});

test('user dashboard shows available quizzes', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();
    $quiz = Quiz::factory()->create([
        'title' => 'Available Quiz',
        'category_id' => $category->id,
    ]);
    Question::factory()->count(3)->create(['quiz_id' => $quiz->id]);

    $response = $this->actingAs($user)->get('/dashboard');

    $response->assertOk();
    $response->assertSee('Available Quiz');
});
