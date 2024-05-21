<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;

class CategoryComponent extends Component
{
    public $categories;

    public $name;

    public $category_id;

    public $isOpen = false;

    public function render()
    {
        $this->categories = Category::all();

        return view('livewire.admin.category-component')->layout('layouts.admin');
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
        $this->name = '';
        $this->category_id = '';
    }

    public function store()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::updateOrCreate(['id' => $this->category_id], $validatedData);

        session()->flash('message',
            $this->category_id ? 'Category Updated Successfully.' : 'Category Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->category_id = $id;
        $this->name = $category->name;

        $this->openModal();
    }

    public function delete($id)
    {
        Category::findOrFail($id)->delete();
        session()->flash('message', 'Category Deleted Successfully.');
    }
}
