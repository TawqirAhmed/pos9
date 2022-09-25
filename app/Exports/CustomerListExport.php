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

use App\Models\Customer;

class CustomerListExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */

     /**
    * @return \Illuminate\Support\Collection
    */
     // varible form and to 
     // public function __construct(String $from = null , String $to = null)
     // {
     //     $this->from = $from;
     //     $this->to   = $to;
     // }
    public function collection()
    {

        $customers = Customer::all();
        
        $data = collect();    

        foreach ($customers as $key => $value) {
            $temp = collect();

            $temp['id'] = $value->id;
            $temp['name'] = $value->name;
            $temp['code'] = $value->code;
            $temp['contact'] = $value->contact;

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
             'Code',
             'Contact',
        ];
    }
}
