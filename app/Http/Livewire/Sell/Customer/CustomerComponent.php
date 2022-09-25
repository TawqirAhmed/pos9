<?php

namespace App\Http\Livewire\Sell\Customer;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Customer;

class CustomerComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $paginate = 10;
    public $search = "";

    public $name, $contact;

    public $edit_id, $e_name, $e_contact;

    public function Store()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'contact' => 'required',
        ]);

        $data = new Customer();

        $data->name = $this->name;
        $data->code = self::make_code($data);
        $data->contact = $this->contact;

        $done = $data->save();

        if ($done) {
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'success',  'message' => 'Customer Added Successfuly']);
        }

        $this->name = null;
        $this->contact = null;

        $this->emit('storeSomething');
    }

    public function render()
    {
        $customers = Customer::with('user')->search(trim($this->search))->paginate($this->paginate);
        return view('livewire.sell.customer.customer-component',compact('customers'))->layout('livewire.base.base');
    }

    public function getItem($id)
    {
        $this->edit_id = $id;
        $data = Customer::find($id);

        $this->e_name = $data->name;
        $this->e_contact = $data->contact;
    }

    public function Update()
    {
        $validatedData = $this->validate([
            'e_name' => 'required',
            'e_contact' => 'required',
        ]);

        $data = Customer::find($this->edit_id);

        $data->name = $this->e_name;
        $data->contact = $this->e_contact;
        $data->user_id = auth()->user()->id;

        $done = $data->save();

        if ($done) {
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'success',  'message' => 'Curtomer Info Updated Successfuly']);
        }

        $this->edit_id = null;
        $this->e_name = null;
        $this->e_Contact = null;

        $this->emit('storeSomething');
    }

    public function make_code($data)
    {
        $lastInvoiceID = $data->orderBy('id', 'DESC')->pluck('id')->first();
        $newInvoiceID = $lastInvoiceID + 1;

        // str_pad($newInvoiceID, 6, '0', STR_PAD_LEFT);

        return str_pad($newInvoiceID, 6, '0', STR_PAD_LEFT);
    }

}
