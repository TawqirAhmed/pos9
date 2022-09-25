<?php

namespace App\Http\Livewire\Report\Profit;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Sell;
use App\Models\Refund;

use Carbon\Carbon;

class ProfitComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $paginate = 10;
    public $search = "";

    public $from, $to;
    public $temp_from, $temp_to;

    public $products=[], $bill_no, $profit;

    public function setDate()
    {
        $this->from = $this->temp_from;
        $this->to = $this->temp_to;
    }

    public function getItem($id)
    {
        $data = Sell::find($id);
        $this->products = json_decode($data->products);
        $this->bill_no = $data->bill_no;
        $this->profit = $data->profit;
    }

    public function mount()
    {
        $this->to = (Carbon::now())->format('Y-m-d');
        $this->from = ((Carbon::now())->firstOfMonth())->format('Y-m-d');
    }

    public function render()
    {
        $sales = Sell::whereBetween('created_at',[Carbon::parse($this->from),Carbon::parse($this->to)->addDays(1)])->orderBy('id','desc')->search(trim($this->search))->paginate($this->paginate);
        return view('livewire.report.profit.profit-component',compact('sales'))->layout('livewire.base.base');
    }
}
