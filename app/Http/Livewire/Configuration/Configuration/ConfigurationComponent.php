<?php

namespace App\Http\Livewire\Configuration\Configuration;

use Livewire\Component;
use Livewire\WithFileUploads;

use App\Models\Configuration;

class ConfigurationComponent extends Component
{
    use WithFileUploads;

    public $vat, $company_name, $address_line_1, $address_line_2, $phone, $logo, $logo_sm, $favicon;

    public $new_logo, $new_logo_sm, $new_favicon;

    public function mount()
    {
        $data = Configuration::find(1);
    
        if (!$data) {

            $config = new Configuration();

            $config->vat = 0;
            $config->company_name = 'Company/Shop Name';
            $config->address_line_1 = 'Address Line 1';
            $config->address_line_2 = 'Address Line 2';
            $config->phone = '01xxxxxxxxx';

            $config->save();
        }

        $data = Configuration::find(1);

        $this->vat = $data->vat;
        $this->company_name = $data->company_name;
        $this->address_line_1 = $data->address_line_1;
        $this->address_line_2 = $data->address_line_2;
        $this->phone = $data->phone;
        $this->logo = $data->logo;
        $this->logo_sm = $data->logo_sm;
        $this->favicon = $data->favicon;
    }




    public function UpdateVAT()
    {

        $validatedData = $this->validate([
            'vat' => 'required|numeric',
        ]);

        $data = Configuration::find(1);

        $data->vat = $this->vat;

        $done = $data->save();

        if ($done) {
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'success',  'message' => 'VAT/Tax Info Updated Successfuly']);
        }
    }

    public function UpdateInfo()
    {

        $validatedData = $this->validate([
            'company_name' => 'required',
            'address_line_1' => 'required',
            'address_line_2' => 'required',
            'phone' => 'required',
        ]);

        $data = Configuration::find(1);

        $data->company_name = $this->company_name;
        $data->address_line_1 = $this->address_line_1;
        $data->address_line_2 = $this->address_line_2;
        $data->phone = $this->phone;

        $done = $data->save();

        if ($done) {
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'success',  'message' => 'Company Info Updated Successfuly']);
        }
    }


    public function LogoMain()
    {
        if ($this->new_logo != null) {
            $validatedData = $this->validate([
                'new_logo' => 'image|max:300|mimes:png,jpg,jpeg'
            ]);
        }

        $data = Configuration::find(1);

        $imageName = 'default_logo.png';
        $this->new_logo->storeAs('assets/images',$imageName);
        $data->logo = $imageName;

        $done = $data->save();
        
        if ($done) {
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'success',  'message' => 'Logo Updated Successfuly']);
        }
    }


    public function LogoSm()
    {
        if ($this->new_logo_sm != null) {
            $validatedData = $this->validate([
                'new_logo_sm' => 'image|max:300|mimes:png,jpg,jpeg'
            ]);
        }

        $data = Configuration::find(1);

        $imageName = 'logo-sm.png';
        $this->new_logo_sm->storeAs('assets/images',$imageName);
        $data->logo_sm = $imageName;

        $done = $data->save();
        
        if ($done) {
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'success',  'message' => 'Logo Sm Updated Successfuly']);
        }
    }

    public function Favicon()
    {
        if ($this->new_favicon != null) {
            $validatedData = $this->validate([
                'new_favicon' => 'image|max:300|mimes:png,jpg,jpeg'
            ]);
        }

        $data = Configuration::find(1);

        $imageName = 'favicon.png';
        $this->new_favicon->storeAs('assets/images',$imageName);
        $data->favicon = $imageName;

        $done = $data->save();
        
        if ($done) {
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'success',  'message' => 'Favicon Updated Successfuly']);
        }
    }

    public function render()
    {

        return view('livewire.configuration.configuration.configuration-component')->layout('livewire.base.base');
    }
}
