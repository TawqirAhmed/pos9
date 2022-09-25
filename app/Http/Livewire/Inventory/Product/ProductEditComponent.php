<?php

namespace App\Http\Livewire\Inventory\Product;

use Livewire\Component;
use Livewire\WithFileUploads;

use Illuminate\Validation\Rule;
use App\Models\Product;
use App\Models\Category;


class ProductEditComponent extends Component
{
    use WithFileUploads;
    
    public $category_id, $name, $sku, $description, $buy, $sell, $discount, $new, $out, $stock, $user_id, $image, $e_image;
    public $product_id;

    public function Update()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            // 'sku' => 'required|unique:products',
            'buy' => 'required|numeric',
            'sell' => 'required|numeric',
            'discount' => 'required|numeric',
            'stock' => 'required|numeric',
            'sku'=>[
                'required',
                Rule::unique('products', 'sku')->ignore($this->product_id)
                ],
        ]);

        if ($this->e_image != null) {
            $validatedData = $this->validate([
                'e_image' => 'image|max:300|mimes:png,jpg,jpeg'
            ]);
        }

        $data = Product::find($this->product_id);

        $data->category_id = $this->category_id;
        $data->name = $this->name;
        $data->sku = $this->sku;
        $data->description = $this->description;
        $data->buy = $this->buy;
        $data->sell = $this->sell;
        $data->discount = $this->discount;
        $data->stock = $this->stock;
        $data->user_id = auth()->user()->id;
        // $data->image = $this->;

        if ($this->e_image != null) {
            $imageName = $this->name.'_'.$this->sku.'.png';
            $this->e_image->storeAs('uploads/products',$imageName);
            $data->image = $imageName;
        }

        $done = $data->save();

        if ($done) {
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'success',  'message' => 'Product Updated Successfuly']);
        }
    }

    public function mount($id)
    {
        $this->product_id = $id;

        $data = Product::find($id);

        $this->category_id = $data->category_id;
        $this->name = $data->name;
        $this->sku = $data->sku;
        $this->description = $data->description;
        $this->buy = $data->buy;
        $this->sell = $data->sell;
        $this->discount = $data->discount;
        $this->stock = $data->stock;
        $this->image = $data->image;
    }

    public function render()
    {   
        $categories = Category::all();
        return view('livewire.inventory.product.product-edit-component',compact('categories'))->layout('livewire.base.base');
    }
}
