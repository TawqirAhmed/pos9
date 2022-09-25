<?php

namespace App\Http\Livewire\Sell\Sell;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Sell;
use App\Models\PaymentMethod;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Configuration;

class MakeSellComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $paginate = 10;
    public $search = "";

    public $product_list = [

        ];

    public $Gtotal = 0;
    public $subTotal = 0;

    public $payment_method_id="", $customer_id="";


    public $paid;

    public $barcode;


    public $name, $contact;
    public $iteration = 0;

    public function addToList($sku)
    {
        $getP =self::getProduct($sku);

        $indexkey =self::existProduct($getP->sku);

        if ($getP->stock == 0) {
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'warning',  'message' => $getP->name .' Out of Stock.']);
            return;
        }

        if ($indexkey !=-1) {
            
            if ($getP->stock == $this->product_list[$indexkey]['quantity']) {

                $this->dispatchBrowserEvent('alert', 
                    ['type' => 'warning',  'message' => 'Quantity Higher Than '. $getP->name .' Stock.']);
                return;
            }
            $this->product_list[$indexkey]['quantity']++;

            $this->product_list = array_values($this->product_list);

            $this->Gtotal = self::Total();
        }else{
            $this->product_list[] = [
                'name'=>$getP->name,
                'sku'=>$getP->sku,
                'price'=>$getP->sell,
                'quantity'=>'1',
                'total'=>$getP->total,
            ];
            $this->Gtotal = self::Total();
        }
    }

    public function remove($pId)
    {
        unset($this->product_list[$pId]);

        $this->product_list = array_values($this->product_list);
        $this->Gtotal = self::Total();
    }


    public function updateqty($pId,$nqty)
    {
        if ($nqty<1) {
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'warning',  'message' => 'Quantity Must be 1 or Greater']);
            return;
        }
        $getP =self:: getProduct($this->product_list[$pId]['sku']);
        if ($getP->stock<$nqty) {

            $this->product_list = array_values($this->product_list);

            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'warning',  'message' => 'Quantity Higher Than '. $getP->name .' Stock.']);
            return;
        }else{
            $this->product_list[$pId]['quantity'] = $nqty;

            $this->product_list = array_values($this->product_list);

            $this->Gtotal = self::Total();
        }
    }


    public function getProduct($newP)
    {
        
        $productInfo =  Product::where('sku',$newP)->first();
        return $productInfo;
    }

    public function existProduct($sku)
    {
        $indexkey = -1;
        foreach ($this->product_list as $key=>$value) {
            if($value['sku'] == $sku){
                $indexkey = $key;
            }
        }
        // dd($this->product_list,$indexkey,$sku);
        return $indexkey;
    }

    public function Total()
    {
        $total=0;
        foreach ($this->product_list as $key) {
            $total=$total + $key['price']*$key['quantity'];
        }

        // $vat = 15;
        // $tax = ($total/100)*$vat->vat;

        $vat = 15;
        $tax = ($total/100)*$vat;

        $this->subTotal = $total;
        return ($total + $tax);
    }



    public function Store()
    {
        if ($this->Gtotal <= 0) {
           $this->dispatchBrowserEvent('alert', 
                    ['type' => 'warning',  'message' => 'Invoice is empty. Add Some Product.']);
            return;
        }

        //calculating profits-----------------------------------------------------------

        $profit_total = 0;

        foreach ($this->product_list as $kay=>$value) {
            $temp_product = Product::where('sku',$value['sku'])->first();

            $profit_single = $value['price'] - $temp_product->buy;
            $p_total = 0;
            if ($profit_single >=0) {
                $p_total = $value['quantity']*$profit_single;
            }

            $profit_total = $profit_total + $p_total;
        
        }
        //calculating profits-----------------------------------------------------------

        //Sales table insert---------------------------------------------------------------
        $data = new Sell();

        $lastInvoiceID = $data->orderBy('id', 'DESC')->pluck('id')->first();
        $newInvoiceID = $lastInvoiceID + 1;

        $bill_no = str_pad($newInvoiceID, 6, '0', STR_PAD_LEFT); //------Bill no ---------------        


        $due = 0;

        if ($this->paid < $this->Gtotal) {
            $due = $this->Gtotal - $this->paid;
        }

        $configuration = Configuration::find(1);

        $vat = $configuration->vat;

        $data->products = json_encode($this->product_list);
        $data->bill_no = $bill_no;
        $data->customer_id = $this->customer_id;
        $data->payment_method_id = $this->payment_method_id;
        $data->net_price = $this->subTotal;
        $data->paid = $this->paid;
        $data->due = $due;
        $data->vat_percent = $vat;
        $data->vat_amount = $this->Gtotal - $this->subTotal;
        $data->total_price = $this->Gtotal;
        $data->profit = $profit_total;
        
        $data->save();
        //Sales table insert---------------------------------------------------------------

        //Stock Adjust--------------------------------------------------------------------
        foreach ($this->product_list as $key => $value) {
            
            $data2 = Product::where('sku',$value['sku'])->first();

            $data2->stock = $data2->stock - $value['quantity'];
            $data2->out = $data2->out + $value['quantity'];

            $data2->save();
        }
        //Stock Adjust--------------------------------------------------------------------



        $this->product_list = [

            ];
        $this->Gtotal = 0;
        $this->subTotal = 0;
        $this->payment_method_id="";
        $this->customer_id="";
        $this->paid = null;


        return redirect()->route('print_invoice',$data->id);
    }   

    public function barcodeAdd($sku)
    {
        self::addToList($sku);

        $this->barcode = null;
    }

    public function render()
    {
        $payment_methods = PaymentMethod::all();
        $customers = Customer::all();
        $products = Product::search(trim($this->search))->paginate($this->paginate);
        return view('livewire.sell.sell.make-sell-component',compact('payment_methods','customers','products'))->layout('livewire.base.base');
    }



    public function StoreCustomer()
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
        $this->emit('customerUpdate');
        $this->iteration++;
    }

    public function make_code($data)
    {
        $lastInvoiceID = $data->orderBy('id', 'DESC')->pluck('id')->first();
        $newInvoiceID = $lastInvoiceID + 1;

        // str_pad($newInvoiceID, 6, '0', STR_PAD_LEFT);

        return str_pad($newInvoiceID, 6, '0', STR_PAD_LEFT);
    }

}
