<?php

namespace App\Http\Livewire\Configuration\Payment;

use Livewire\Component;

use App\Models\PaymentMethod;

class PaymentComponent extends Component
{
    public $name, $description;

    public $edit_id, $e_name, $e_description;

    public function Store()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $data = new PaymentMethod();

        $data->name = $this->name;
        $data->description = $this->description;

        $done = $data->save();

        if ($done) {
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'success',  'message' => 'Payment Method Added Successfuly']);
        }

        $this->name = null;
        $this->description = null;

        $this->emit('storeSomething');
    }

    public function getItem($id)
    {
        $this->edit_id = $id;
        $data = PaymentMethod::find($id);

        $this->e_name = $data->name;
        $this->e_description = $data->description;
    }

    public function Update()
    {
        $validatedData = $this->validate([
            'e_name' => 'required',
            'e_description' => 'required',
        ]);

        $data = PaymentMethod::find($this->edit_id);

        $data->name = $this->e_name;
        $data->description = $this->e_description;

        $done = $data->save();

        if ($done) {
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'success',  'message' => 'Payment Method Updated Successfuly']);
        }

        $this->edit_id = null;
        $this->e_name = null;
        $this->e_description = null;

        $this->emit('storeSomething');
    }

    public function render()
    {
        $payment_methods = PaymentMethod::all();
        return view('livewire.configuration.payment.payment-component',compact('payment_methods'))->layout('livewire.base.base');
    }
}
