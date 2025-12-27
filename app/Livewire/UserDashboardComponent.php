<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Result;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserDashboardComponent extends Component
{
    public $results;

    public $categories;

    public function mount()
    {
        $this->loadResults();
        $this->loadCategories();
    }

    private function loadResults()
    {
        $this->results = Result::where('user_id', Auth::id())
            ->with(['quiz' => function ($query) {
                $query->withCount('questions');
            }])
            ->latest()
            ->get();
    }

    private function loadCategories()
    {
        $this->categories = Category::with(['quizzes' => function ($query) {
            $query->withCount('questions');
        }])->get();
    }

    public function render()
    {
        return view('livewire.user-dashboard-component')->layout('layouts.app');
    }
}
