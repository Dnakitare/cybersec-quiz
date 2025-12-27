<?php

namespace App\Livewire;

use App\Models\Quiz;
use App\Models\Result;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class QuizTakingComponent extends Component
{
    public Quiz $quiz;

    public $answers = [];

    /**
     * Mount the quiz and prevent duplicate submissions.
     */
    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz->load('questions');
        // If the user already has a result for this quiz, redirect
        if (Result::where('user_id', Auth::id())->where('quiz_id', $this->quiz->id)->exists()) {
            session()->flash('error', 'You have already taken this quiz.');
            return redirect()->route('dashboard');
        }
    }

    public function submitQuiz()
    {
        $totalQuestions = $this->quiz->questions->count();
        $score = $this->calculateScore();

        Result::create([
            'user_id' => Auth::id(),
            'quiz_id' => $this->quiz->id,
            'score' => $score,
        ]);

        session()->flash('message', 'Quiz submitted successfully. Your score is '.$score.'/'.$totalQuestions);

        return redirect()->route('dashboard');
    }

    private function calculateScore()
    {
        $score = 0;
        foreach ($this->quiz->questions as $question) {
            if (isset($this->answers[$question->id]) && $this->answers[$question->id] === $question->correct_answer) {
                $score++;
            }
        }

        return $score;
    }

    public function render()
    {
        $viewQuestions = $this->quiz->questions->map(function ($question) {
            return [
                'id' => $question->id,
                'text' => $question->text,
                'options' => $question->options,
            ];
        })->all();

        return view('livewire.quiz-taking-component', [
            'viewQuestions' => $viewQuestions,
        ])->layout('layouts.app');
    }
}
