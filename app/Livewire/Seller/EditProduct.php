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
class EditProduct extends Component
{
    use WithFileUploads;

    public Product $product;
    public ?\Livewire\TemporaryUploadedFile $file = null;

    public function mount(Product $product): void
    {
        $this->product = $product;
    }

    protected function rules(): array
    {
        return [
            'product.name' => 'required|string|max:255',
            'product.price' => 'required|numeric|min:0',
            'file' => 'nullable|file',
            'product.category_id' => 'required|exists:categories,id',
            'product.description' => 'nullable|string',
        ];
    }

    public function save()
    {
        $this->validate();

        if ($this->file) {
            $path = $this->file->store('', 'products');
            $this->product->file_path = $path;
        }

        $this->product->slug = Str::slug($this->product->name);
        $this->product->save();

        return redirect()->route('seller.products.my');
    }

    public function render()
    {
        return view('seller.edit-product', [
            'categories' => Category::orderBy('name')->get(),
        ]);
    }
}
