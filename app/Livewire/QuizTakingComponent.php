<?php

namespace App\Livewire;

use App\Models\Quiz;
use App\Models\Result;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class QuizTakingComponent extends Component
{
    public $quiz;

    public $questions;

    public $answers = [];

    public function mount($quizId)
    {
        $this->quiz = Quiz::with('questions')->findOrFail($quizId);
        $this->questions = $this->quiz->questions;
    }

    public function submitQuiz()
    {
        $score = $this->calculateScore();

        Result::create([
            'user_id' => Auth::id(),
            'quiz_id' => $this->quiz->id,
            'score' => $score,
        ]);

        session()->flash('message', 'Quiz submitted successfully. Your score is '.$score.'/'.$this->questions->count());

        return redirect()->route('dashboard');
    }

    private function calculateScore()
    {
        $score = 0;
        foreach ($this->questions as $question) {
            if ($this->answers[$question->id] === $question->correct_answer) {
                $score++;
            }
        }

        return $score;
    }

    public function render()
    {
        return view('livewire.quiz-taking-component')->layout('layouts.app');
    }
}
