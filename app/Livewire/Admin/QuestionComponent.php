<?php

namespace App\Livewire\Admin;

use App\Models\Question;
use App\Models\Quiz;
use Livewire\Component;

class QuestionComponent extends Component
{
    public $questions;

    public $quiz_id;

    public $text;

    public $options;

    public $correct_answer;

    public $question_id;

    public $isOpen = false;

    public function render()
    {
        $this->questions = Question::with('quiz')->get();

        return view('livewire.admin.question-component', [
            'quizzes' => Quiz::all(),
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
            'correct_answer' => 'required|string',
        ]);

        Question::updateOrCreate(['id' => $this->question_id], $validatedData);

        session()->flash('message',
            $this->question_id ? 'Question Updated Successfully.' : 'Question Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
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
    }
}
