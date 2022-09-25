<?php

namespace App\Http\Livewire\Sell\Refund;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Refund;
use App\Models\Sell;

class RefundComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $paginate = 10;
    public $search = "";
    
    public $name, $bill_no, $description, $amount;

    public $edit_id, $e_name, $e_bill_no, $e_description, $e_amount;

    public function Store()
    {
        $sell_data = Sell::where('bill_no',$this->bill_no)->first();
        
        if(!$sell_data){
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'error',  'message' => 'No Sell Found With Bill No ' . $this->bill_no]);
            $this->emit('storeSomething');
            return;
        }

        $data = new Refund();

        $data->name = $this->name;
        $data->description = $this->description;
        $data->amount = $this->amount;
        $data->sell_id = $sell_data->id;

        $done = $data->save();

        if ($done) {
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'success',  'message' => 'Refund Added Successfuly']);
        }

        $this->name = null;
        $this->bill_no = null;
        $this->description = null;
        $this->amount = null;

        $this->emit('storeSomething');
    }

    public function getItem($id)
    {
        $this->edit_id = $id;
        $data = Refund::where('id',$id)->with('sell')->first();

        $this->e_name = $data->name;
        $this->e_description = $data->description;
        $this->e_bill_no = $data->sell->bill_no;
        $this->e_amount = $data->amount;
    }


    public function Update()
    {
        $sell_data = Sell::where('bill_no',$this->e_bill_no)->first();
        
        if(!$sell_data){
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'error',  'message' => 'No Sell Found With Bill No ' . $this->bill_no]);
            $this->emit('storeSomething');
            return;
        }

        $data = Refund::find($this->edit_id);

        $data->name = $this->e_name;
        $data->description = $this->e_description;
        $data->amount = $this->e_amount;
        $data->sell_id = $sell_data->id;
        $data->user_id = auth()->user()->id;

        $done = $data->save();

        if ($done) {
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'success',  'message' => 'Refund Updated Successfuly']);
        }

        $this->edit_id = null;
        $this->e_name = null;
        $this->e_bill_no = null;
        $this->e_description = null;
        $this->e_amount = null;

        $this->emit('storeSomething');
    }

    public function render()
    {
        $refunds = Refund::with('user','sell')->search(trim($this->search))->paginate($this->paginate);
        return view('livewire.sell.refund.refund-component',compact('refunds'))->layout('livewire.base.base');
    }
}
