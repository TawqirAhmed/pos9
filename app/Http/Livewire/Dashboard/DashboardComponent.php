<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

use App\Models\Sell;

use Carbon\Carbon;
use DB;
class DashboardComponent extends Component
{


    public $from, $to, $from_to_be_set, $to_to_be_set;

    public $bar_chart_date, $bar_chart_amount;

    public function mount()
    {
        $this->from = Carbon::now()->subMonths(1)->format('Y-m-d');
        $this->to = Carbon::now()->format('Y-m-d');

        //For Sale
        self::SetSales();
         
    }

    public function SetSales()
    {
        $sales = DB::table('sells')->select(DB::raw('sum(total_price) as price'),DB::raw('DATE(created_at) as day'))->groupBy('day')->whereBetween('created_at', [$this->from, $this->to])->get();

        // $from = '2022-08-20';
        // $to = '2022-08-21';

        // $sales = DB::table('sells')->select(DB::raw('sum(total_price) as price'),DB::raw('DATE(created_at) as day'))->groupBy('day')->whereBetween('created_at', [$from, $to])->get();

        // dd($sales);

        $temp_date = array();
        $temp_amount = array();

        foreach ($sales as $key =>$value) {
            array_push($temp_date, $value->day);
            array_push($temp_amount, $value->price);
        }

        $this->bar_chart_date = $temp_date;
        $this->bar_chart_amount = $temp_amount;
    }


    public function setDates()
    {
        $validatedData = $this->validate([
            'from_to_be_set' => 'required',
            'to_to_be_set' => 'required',
        ]);


        $this->from = Carbon::parse($this->from_to_be_set)->format('Y-m-d');
        $this->to = Carbon::parse($this->to_to_be_set)->format('Y-m-d');

    // $sales = DB::table('sells')->select(DB::raw('sum(total_price) as price'),DB::raw('DATE(created_at) as day'))->groupBy('day')->whereBetween('created_at', [$this->from, $this->to])->get();

    // dd($this->from, $this->to, $sales);
        //For Sale
        self::SetSales();


        self::dispatchListener();

    }


    public function dispatchListener()
    {
        $this->dispatchBrowserEvent('contentChanged', [
            'bar_chart_date' => $this->bar_chart_date, 
            'bar_chart_amount' => $this->bar_chart_amount
            ]);
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard-component')->layout('livewire.base.base');
    }
}
