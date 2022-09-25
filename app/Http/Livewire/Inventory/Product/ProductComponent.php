<?php

namespace App\Http\Livewire\Inventory\Product;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Product;

class ProductComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $paginate = 10;
    public $search = "";
    
    public function render()
    {
        $products = Product::with('user','category')->search(trim($this->search))->paginate($this->paginate);
        return view('livewire.inventory.product.product-component',compact('products'))->layout('livewire.base.base');
    }
}
