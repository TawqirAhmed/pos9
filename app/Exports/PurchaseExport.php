<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\ProductPurchase;

class PurchaseExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(String $from = null , String $to = null, String $name = null)
     {
         $this->from = $from;
         $this->to   = $to;
     }
    public function collection()
    {
        $sells = ProductPurchase::with('user', 'supplier')->where('created_at','>=',$this->from)->where('created_at','<=', $this->to)->get();

        $data = collect();    

        foreach ($sells as $key => $value) {
            $temp = collect();

            $temp['id'] = $value->id;
            $temp['products'] = $value->products;
            $temp['supplier'] = $value->supplier->name;
            $temp['user'] = $value->user->name;
            $temp['total'] = $value->total;
            $temp['paid'] = $value->paid;
            $temp['due'] = $value->due;
            $temp['referance'] = $value->referance;
            $temp['purchase_date'] = $value->purchase_date;

            $data->push($temp);
        }

        return $data;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
             
            },
        ];
    }
    
    //function header in excel
     public function headings(): array
     {
         return [
            'Id',
            'Products',
            'Supplier',
            'User',
            'Total',
            'Paid',
            'Due',
            'Referance',
            'Purchase Date'
        ];
    }
}
