<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Result;
use Illuminate\Support\Facades\Auth;

class UserDashboardComponent extends Component
{
    public $results;

    public function mount()
    {
        $this->loadResults();
    }

    private function loadResults()
    {
        $this->results = Result::where('user_id', Auth::id())->with('quiz')->get();
    }

    public function render()
    {
        return view('livewire.user-dashboard-component')->layout('layouts.app');
    }
}
