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

use App\Models\Refund;

class RefundExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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
        $refunds = Refund::with('user', 'sell')->where('created_at','>=',$this->from)->where('created_at','<=', $this->to)->get();

        $data = collect();    

        foreach ($refunds as $key => $value) {
            $temp = collect();

            $temp['id'] = $value->id;
            $temp['name'] = $value->name;
            $temp['bill_no'] = $value->sell->bill_no;
            $temp['amount'] = $value->amount;
            $temp['user_id'] = $value->user->name;
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
            'Name',
            'Bill No',
            'Amount',
            'User',
            'Created At'
        ];
    }
}
