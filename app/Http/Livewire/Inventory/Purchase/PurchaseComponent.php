<?php

namespace App\Http\Livewire\Inventory\Purchase;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\ProductPurchase;

class PurchaseComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $paginate = 10;
    public $search = "";
    
    public function render()
    {
        $purchases = ProductPurchase::with('user','supplier')->search(trim($this->search))->paginate($this->paginate);
        return view('livewire.inventory.purchase.purchase-component',compact('purchases'))->layout('livewire.base.base');
    }
}
