<?php

namespace App\Http\Livewire\Inventory\Product;

use Livewire\Component;
use Livewire\WithFileUploads;

use App\Models\Product;
use App\Models\Category;

class ProductAddComponent extends Component
{
    use WithFileUploads;

    public $category_id, $name, $sku, $description, $buy, $sell, $discount, $new, $out, $stock, $user_id, $image;



    public function Store()
    {


        $validatedData = $this->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'sku' => 'required|unique:products',
            'buy' => 'required|numeric',
            'sell' => 'required|numeric',
            'discount' => 'required|numeric',
            'new' => 'required|numeric',
        ]);

        if ($this->image != null) {
            $validatedData = $this->validate([
                'image' => 'image|max:300|mimes:png,jpg,jpeg'
            ]);
        }


        $data = new Product();

        $data->category_id = $this->category_id;
        $data->name = $this->name;
        $data->sku = $this->sku;
        $data->description = $this->description;
        $data->buy = $this->buy;
        $data->sell = $this->sell;
        $data->discount = $this->discount;
        $data->new = $this->new;
        $data->out = 0;
        $data->stock = $this->new;

        if ($this->image != null) {
            $imageName = $this->name.'_'.$this->sku.'.png';
            $this->image->storeAs('uploads/products',$imageName);
            $data->image = $imageName;
        }


        $done = $data->save();

        if ($done) {
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'success',  'message' => 'Product Added Successfuly']);
        }

        $this->category_id = null;
        $this->name = null;
        $this->sku = null;
        $this->description = null;
        $this->buy = null;
        $this->sell = null;
        $this->discount = null;
        $this->new = null;
        $this->new = null;
        $this->image = null;

    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.inventory.product.product-add-component',compact('categories'))->layout('livewire.base.base');
    }
}
