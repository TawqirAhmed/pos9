<?php

namespace App\Http\Livewire\Sell\Sell;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Sell;

class SellRecordComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $paginate = 10;
    public $search = "";
    
    public $edit_id, $paying, $paid, $due, $total_price, $bill_no;


    public function getItem($id)
    {
        $this->edit_id = $id;
        $data = Sell::find($id);

        $this->paid = $data->paid;
        $this->due = $data->due;
        $this->total_price = $data->total_price;
        $this->bill_no = $data->bill_no;
    }

    public function dueAdjust()
    {
        $paid = $this->paid;
        $due = $this->due;

        if ($this->paying > $this->due) {
            $paid = $this->total_price;
            $due = 0;
        } else {
            $paid = $paid + $this->paying;
            $due = $due - $this->paying;
        }
        
        $data = Sell::find($this->edit_id);

        $data->due = $due;
        $data->paid = $paid;
        $data->user_id = auth()->user()->id;

        $done = $data->save();

        if ($done) {
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'success',  'message' => 'Due Adjusted Successfully']);
        }

        $this->edit_id = null;
        $this->paying = null;
        $this->paid = null;
        $this->due = null;
        $this->total_price = null;
        $this->bill_no = null;

        $this->emit('storeSomething');
    }


    public function render()
    {
        $sells = Sell::with('user','customer','payment_method')->orderBy('id','desc')->search(trim($this->search))->paginate($this->paginate);
        return view('livewire.sell.sell.sell-record-component',compact('sells'))->layout('livewire.base.base');
    }
}
