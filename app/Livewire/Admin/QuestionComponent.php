<?php

namespace App\Livewire\Admin;

use App\Models\Question;
use App\Models\Quiz;
use Livewire\Component;
use Livewire\WithPagination;

class QuestionComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';

    public $questions;

    public $quiz_id;

    public $text;

    public $options;

    public $correct_answer;

    public $question_id;

    public $isOpen = false;

    public function render()
    {
        $questions = Question::with('quiz')->paginate(10);

        return view('livewire.admin.question-component', [
            'quizzes' => Quiz::all(),
            'questions' => $questions,
        ])->layout('layouts.admin');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->text = '';
        $this->options = [];
        $this->correct_answer = '';
        $this->quiz_id = '';
        $this->question_id = '';
    }

    public function store()
    {
        $validatedData = $this->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'text' => 'required|string|max:255',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string|max:500',
            'correct_answer' => 'required|string|in_array:options.*',
        ], [
            'correct_answer.in_array' => 'The correct answer must be one of the option keys.',
        ]);

        // Ensure correct_answer is a valid option key
        if (!array_key_exists($this->correct_answer, $this->options)) {
            $this->addError('correct_answer', 'The correct answer must match one of the option keys (e.g., A, B, C, D).');
            return;
        }

        Question::updateOrCreate(['id' => $this->question_id], $validatedData);

        session()->flash('message',
            $this->question_id ? 'Question Updated Successfully.' : 'Question Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
        $this->resetPage();
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);
        $this->question_id = $id;
        $this->quiz_id = $question->quiz_id;
        $this->text = $question->text;
        $this->options = $question->options;
        $this->correct_answer = $question->correct_answer;
        $this->openModal();
    }

    public function delete($id)
    {
        Question::findOrFail($id)->delete();
        session()->flash('message', 'Question Deleted Successfully.');
        $this->resetPage();
    }
}
