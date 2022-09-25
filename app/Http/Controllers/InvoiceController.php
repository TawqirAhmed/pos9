<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Sell;
use App\Models\Configuration;
use PDF;
class InvoiceController extends Controller
{
    public function index($id)
    {
        $invoice = Sell::where('id',$id)->with('user','customer','payment_method')->first();

        $info = Configuration::find(1);

        $data = [

            'invoice' => $invoice,
            'info' => $info,
            'products'=> json_decode($invoice->products)
            ];

        $pdf = PDF::loadView('livewire.sell.sell.invoice', $data);

        return $pdf->stream($invoice->bill_no.'.pdf');
    }
}
