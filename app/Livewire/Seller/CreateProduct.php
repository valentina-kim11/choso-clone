<?php

namespace App\Livewire\Seller;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

#[Layout('components.layouts.market')]
class CreateProduct extends Component
{
    use WithFileUploads;

    public string $name = '';
    public float $price = 0;
    public ?string $description = null;
    public $file;
    public ?int $category_id = null;

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'file' => 'required|file',
            'category_id' => 'required|exists:categories,id',
        ]);

        $path = $this->file->store('', 'products');

        Product::create([
            'user_id' => Auth::id(),
            'category_id' => $this->category_id,
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'price' => $this->price,
            'description' => $this->description,
            'file_path' => $path,
        ]);

        return redirect()->route('products.my');
    }

    public function render()
    {
        return view('seller.create-product', [
            'categories' => Category::orderBy('name')->get(),
        ]);
    }
}
