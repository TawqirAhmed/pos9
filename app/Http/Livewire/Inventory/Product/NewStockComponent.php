<?php

namespace App\Http\Livewire\Inventory\Product;

use Livewire\Component;

use App\Models\Product;
use App\Models\ProductAdd;

class NewStockComponent extends Component
{

    public $qty, $product_name, $product_id;



    public function Update()
    {
        $validatedData = $this->validate([
            'qty' => 'required|numeric',
        ]);

        $data = Product::find($this->product_id);

        $data->stock = $data->stock + $this->qty;
        $data->new = $this->qty;
        $data->user_id = auth()->user()->id;

        $data->save();

        $newData = new ProductAdd();

        $newData->qty = $this->qty;
        $newData->product_id = $this->product_id;

        $done = $newData->save();

        if ($done) {
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'success',  'message' => 'New Stock Added Successfuly']);
        }

        $this->qty = null;
    }


    public function mount($id)
    {

        $this->product_id = $id;

        $data = Product::find($id);

        $this->product_name = $data->name;
    }


    public function render()
    {
        return view('livewire.inventory.product.new-stock-component')->layout('livewire.base.base');
    }
}
