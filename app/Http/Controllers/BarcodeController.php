<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use PDF;
use Picqer\Barcode\BarcodeGeneratorHTML;
class BarcodeController extends Controller
{
    public function index(Request $request,$id)
    {

        $product = Product::find($id);

        $generatorHTML = new BarcodeGeneratorHTML();
        $barcode = $generatorHTML->getBarcode($product->sku, $generatorHTML::TYPE_CODE_128,2,70);

        // $data['barcode'] = $barcode;
        $data = [
            'barcode' => $barcode,
            'product' =>$product
        ];

        // dd($product);

        $customPaper = array(0,0,150.00,250.00);

        $pdf = PDF::loadView('livewire.inventory.product.barcode', $data)->setPaper($customPaper, 'landscape');

        // dd($pdf);

        // return $pdf->download($product->name.'_barcode.pdf');
        return $pdf->stream($product->name.'_barcode.pdf');
    }
}
