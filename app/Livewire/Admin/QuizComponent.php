<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Quiz;
use Livewire\Component;

class QuizComponent extends Component
{
    public $quizzes;

    public $title;

    public $category_id;

    public $quiz_id;

    public $isOpen = false;

    public function render()
    {
        $this->quizzes = Quiz::with('category')->get();

        return view('livewire.admin.quiz-component', [
            'categories' => Category::all(),
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
        $this->title = '';
        $this->category_id = '';
        $this->quiz_id = '';
    }

    public function store()
    {
        $validatedData = $this->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        Quiz::updateOrCreate(['id' => $this->quiz_id], $validatedData);

        session()->flash('message',
            $this->quiz_id ? 'Quiz Updated Successfully.' : 'Quiz Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $quiz = Quiz::findOrFail($id);
        $this->quiz_id = $id;
        $this->title = $quiz->title;
        $this->category_id = $quiz->category_id;

        $this->openModal();
    }

    public function delete($id)
    {
        Quiz::findOrFail($id)->delete();
        session()->flash('message', 'Quiz Deleted Successfully.');
    }
}
