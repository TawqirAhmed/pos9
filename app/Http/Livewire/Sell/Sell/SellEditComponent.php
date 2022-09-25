<?php

namespace App\Http\Livewire\Sell\Sell;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Sell;
use App\Models\PaymentMethod;
use App\Models\Customer;
use App\Models\Product;

class SellEditComponent extends Component
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


    public $edit_id, $paid;
    public $barcode;

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
        $data = Sell::find($this->edit_id);

        //Stock Increase--------------------------------------------------------------------

        $product_main = json_decode($data->products);

        foreach ($product_main as $key => $value) {
            
            $data2 = Product::where('sku',$value->sku)->first();

            $data2->stock = $data2->stock + $value->quantity;
            $data2->out = $data2->out - $value->quantity;

            $data2->save();
        }
        //Stock Increase--------------------------------------------------------------------

        $due = 0;

        if ($this->paid < $this->Gtotal) {
            $due = $this->Gtotal - $this->paid;
        }

        $vat = $data->vat_percent;

        $data->products = json_encode($this->product_list);
        $data->customer_id = $this->customer_id;
        $data->payment_method_id = $this->payment_method_id;
        $data->net_price = $this->subTotal;
        $data->paid = $this->paid;
        $data->due = $due;
        $data->vat_percent = $vat;
        $data->vat_amount = $this->Gtotal - $this->subTotal;
        $data->total_price = $this->Gtotal;
        $data->profit = $profit_total;
        $data->user_id = auth()->user()->id;
        
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

        return redirect()->route('print_invoice',$data->id);
    }


    public function mount($id)
    {
        $this->edit_id = $id;

        $data = Sell::find($id);
        
        $this->Gtotal = $data->total_price;
        $this->subTotal = $data->net_price;
        $this->payment_method_id = $data->payment_method_id;
        $this->customer_id = $data->customer_id;
        $this->paid = $data->paid;

        foreach (json_decode($data->products) as $key => $value) {
            $this->product_list[] = [
                'name'=>$value->name,
                'sku'=>$value->sku,
                'price'=>$value->price,
                'quantity'=>$value->quantity,
                'total'=>$value->total,
            ];

            $this->Gtotal = Self::Total();
        }
        

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
        return view('livewire.sell.sell.sell-edit-component',compact('payment_methods','customers','products'))->layout('livewire.base.base');
    }
}
