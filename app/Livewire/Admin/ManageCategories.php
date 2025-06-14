<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class ManageCategories extends Component
{
    public ?int $editingId = null;
    public string $name = '';

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function save(): void
    {
        $this->validate();
        $slug = Str::slug($this->name);

        if ($this->editingId) {
            Category::where('id', $this->editingId)->update([
                'name' => $this->name,
                'slug' => $slug,
            ]);
            session()->flash('status', 'Category updated.');
        } else {
            Category::create([
                'name' => $this->name,
                'slug' => $slug,
            ]);
            session()->flash('status', 'Category created.');
        }

        $this->reset('name', 'editingId');
    }

    public function edit(int $id): void
    {
        $category = Category::find($id);
        if ($category) {
            $this->editingId = $category->id;
            $this->name = $category->name;
        }
    }

    public function delete(int $id): void
    {
        Category::where('id', $id)->delete();
    }

    public function render()
    {
        return view('admin.manage-categories', [
            'categories' => Category::latest()->get(),
        ]);
    }
}
