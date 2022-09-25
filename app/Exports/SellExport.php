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

use App\Models\Sell;

class SellExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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
        $sells = Sell::with('user', 'customer', 'payment_method')->where('created_at','>=',$this->from)->where('created_at','<=', $this->to)->get();

        $data = collect();    

        foreach ($sells as $key => $value) {
            $temp = collect();

            $temp['id'] = $value->id;
            $temp['products'] = $value->products;
            $temp['bill_no'] = $value->bill_no;
            $temp['customer_id'] = $value->customer->name;
            $temp['user_id'] = $value->user->name;
            $temp['payment_method_id'] = $value->payment_method->name;
            $temp['net_price'] = $value->net_price;
            $temp['paid'] = $value->paid;
            $temp['due'] = $value->due;
            $temp['vat_percent'] = $value->vat_percent;
            $temp['vat_amount'] = $value->vat_amount;
            $temp['total_price'] = $value->total_price;
            $temp['profit'] = $value->profit;
            $temp['created_at'] = $value->created_at;

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
            'Bill No',
            'Customer',
            'Seller',
            'Payment Method',
            'Net Price',
            'Paid',
            'Due',
            'Vat Percent',
            'Vat Amount',
            'Total Price',
            'Profit',
            'Sell Date'
        ];
    }
}
