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

use App\Models\Expence;

class ExpancesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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
        $expences = Expence::with('user')->where('created_at','>=',$this->from)->where('created_at','<=', $this->to)->get();

        $data = collect();    

        foreach ($expences as $key => $value) {
            $temp = collect();

            $temp['id'] = $value->id;
            $temp['amount'] = $value->amount;
            $temp['note'] = $value->note;
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
            'Amount',
            'Note',
            'User',
            'Created At'
        ];
    }
}
