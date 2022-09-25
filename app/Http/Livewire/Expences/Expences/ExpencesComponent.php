<?php

namespace App\Http\Livewire\Expences\Expences;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Expence;

class ExpencesComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $paginate = 10;

    public $amount, $note;

    public $edit_id, $e_amount, $e_note;

    public function Store()
    {
        $data = new Expence();

        $data->amount = $this->amount;
        $data->note = $this->note;

        $done = $data->save();

        if ($done) {
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'success',  'message' => 'Expenses Added Successfuly']);
        }

        $this->amount = null;
        $this->note = null;

        $this->emit('storeSomething');
    }

    public function getItem($id)
    {
        $this->edit_id = $id;
        $data = Expence::find($this->edit_id);
        
        $this->e_amount = $data->amount;
        $this->e_note = $data->note;
    }


    public function Update()
    {
        $data = Expence::find($this->edit_id);

        $data->amount = $this->e_amount;
        $data->note = $this->e_note;

        $done = $data->save();

        if ($done) {
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'success',  'message' => 'Expenses Updated Successfuly']);
        }

        $this->e_amount = null;
        $this->e_note = null;

        $this->emit('storeSomething');
    }

    public function render()
    {
        $expences = Expence::with('user')->orderBy('id','desc')->paginate($this->paginate);
        return view('livewire.expences.expences.expences-component',compact('expences'))->layout('livewire.base.base');
    }
}
