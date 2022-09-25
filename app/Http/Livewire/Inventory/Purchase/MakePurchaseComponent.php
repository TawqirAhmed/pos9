<?php

namespace App\Http\Livewire\Inventory\Purchase;

use Livewire\Component;

use App\Models\Product;
use App\Models\ProductPurchase;

class MakePurchaseComponent extends Component
{
    public $pProducts = [
        
    ];

    public $newProduct = "";

    public $Gtotal = 0;

    public $paid, $supplier_id = "", $purchase_date;

    public function addProduct()
    {
        if ($this->newProduct == '') {
            return;
        }

        $getP =self:: getProduct($this->newProduct);

        if (!$getP) {
            session()->flash('p_not_found', 'Product Not Found.');
            return;
        }

        $indexkey =self::existProduct($getP->id);

        if ($indexkey !=-1) {
            $this->pProducts[$indexkey]['quantity']++;

            $this->pProducts = array_values($this->pProducts);

            $this->newProduct = "";
            $this->Gtotal = Self::Total();
        }else{

        $this->pProducts[] = [
            'id'=>$getP->id,
            'name'=>$getP->name,
            'sku'=>$getP->sku,
            'price'=>$getP->buy,
            'quantity'=>'1',
        ];

        $this->newProduct = "";
        $this->Gtotal = Self::Total();
        }
    }


    public function remove($pId)
    {
        unset($this->pProducts[$pId]);

        $this->pProducts = array_values($this->pProducts);
        $this->Gtotal = Self::Total();
    }

    public function updateqty($pId,$nqty)
    {
        // dd($pId,$nqty);

        if ($nqty !=null) {
            $this->pProducts[$pId]['quantity'] = $nqty;

            $this->pProducts = array_values($this->pProducts);

            $this->Gtotal = Self::Total();
        }else{
            return;
        }
    }

    public function updateprice($pId,$nprice)
    {
        // dd($pId,$nqty);
        if ($nprice !=null) {
            $this->pProducts[$pId]['price'] = $nprice;

            $this->pProducts = array_values($this->pProducts);
            $this->Gtotal = Self::Total();
        }else{
            return;
        }
    }



    public function render()
    {
        return view('livewire.inventory.purchase.make-purchase-component')->layout('livewire.base.base');
    }


    public function getProduct($newP)
    {
        $info = explode(':', $newP);
        if (count($info)<2) {
            return;
        }
        $Product_name = $info[0];
        $Product_sku = $info[1];

        $productInfo = Product::where('sku',$Product_sku)->first();

        return $productInfo;
    }

    public function Total()
    {
        $total=0;
        foreach ($this->pProducts as $key) {
            $total=$total + $key['price']*$key['quantity'];
        }

        return $total;
    }

    public function existProduct($sku)
    {
        $indexkey = -1;
        foreach ($this->pProducts as $key=>$value) {
            if($value['id'] == $sku){
                $indexkey = $key;
            }
        }

        return $indexkey;
    }

    public function Store()
    {
        
        $data = new ProductPurchase();

        $lastInvoiceID = $data->orderBy('id', 'DESC')->pluck('id')->first();
        $newInvoiceID = $lastInvoiceID + 1;

        
        $paidCal=0;
        $dueCal = 0;
        if ($this->paid > $this->Gtotal) {
            $paidCal=$this->Gtotal;
        }else{
            $paidCal=$this->paid;
            $dueCal = $this->Gtotal-$this->paid;
        }

        // dd($this->supplier_id);

        $data->supplier_id = $this->supplier_id;
        $data->products = json_encode($this->pProducts);
        $data->total = $this->Gtotal;
        $data->paid = $paidCal;
        $data->due = $dueCal;
        $data->referance = $newInvoiceID;
        $data->purchase_date = $this->purchase_date;

        $done = $data->save();

        if ($done) {
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'success',  'message' => 'Purchase Added Successfuly']);
        }

        $this->pProducts = [
            
        ];

        $this->newProduct = "";

        $this->Gtotal = 0;

        $this->paid = null;
        $this->supplier_id = "";
        $this->purchase_date = null;
    }


}
