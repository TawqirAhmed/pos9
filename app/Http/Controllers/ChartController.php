<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Sell;
use DB;
class ChartController extends Controller
{
    public function index(Request $request)
    { 
        
        $from;
        $to;

        $method = $request->method();
        if ($request->isMethod('post'))
        {
            // dd($request->all());
            $from = $request->from;
            $to =date('Y-m-d', strtotime($request->to. ' + 1 days'));

            $request_from = $request->from;
            $request_to = $request->to;

        }else{
            $from = date('Y-m-d', strtotime('today - 30 days'));
            $to = date('Y-m-d', strtotime($request->to. ' + 1 days'));

            $request_from = $from;
            $request_to = date('Y-m-d');
        }

        $SellsChart = self::SellsChart($from,$to);
        $bar_chart_amount = $SellsChart['amount'];
        $bar_chart_date = $SellsChart['date'];

        $TopProducts = self::TopProducts($from,$to);
        $top_products_name = $TopProducts['name'];
        $top_products_qty = $TopProducts['qty'];
        $low_products_name = $TopProducts['name_desc'];
        $low_products_qty = $TopProducts['qty_desc'];

        return view('livewire.dashboard.dashboard-component',compact(

                    'request_to',
                    'request_from',
                    'bar_chart_amount',
                    'bar_chart_date',
                    'top_products_name',
                    'top_products_qty',
                    'low_products_name',
                    'low_products_qty'

                    ));
    }



    public function SellsChart($from, $to)
    {
        $sales = Sell::select(DB::raw('sum(total_price) as price'),DB::raw('DATE(created_at) as day'))->groupBy('day')->whereBetween('created_at', [$from, $to])->get();

        $temp_date = array();
        $temp_amount = array();

        foreach ($sales as $key =>$value) {
            array_push($temp_date, $value->day);
            array_push($temp_amount, $value->price);
        }

        $data = [
            'date'=>$temp_date,
            'amount'=>$temp_amount

        ];

        return $data;
    }

    public function TopProducts($from, $to)
    {
        $sales = Sell::whereBetween('created_at', [$from, $to])->get();

        $temp_products = array();
        $temp_qty = array();

        $array_temp=array();

        foreach ($sales as $key =>$value) {
            
            $temp_array = json_decode($value->products);
            foreach ($temp_array as $temp) {
                if (array_key_exists($temp->name,$array_temp)) {
                    $array_temp[$temp->name] = $array_temp[$temp->name] + $temp->quantity;
                }else{
                    $array_temp[$temp->name] = $temp->quantity;
                }
            }
        }

        
        arsort($array_temp);

        $counter = 0;

        foreach ($array_temp as $key => $value) {
            array_push($temp_products, $key);
            array_push($temp_qty, $value);
            if($counter >= 5){
                break;
            }else{
                $counter++;
            }
        }


        $temp_products_desc = array();
        $temp_qty_desc = array();

        asort($array_temp);
        $counter = 0;

        foreach ($array_temp as $key => $value) {
            array_push($temp_products_desc, $key);
            array_push($temp_qty_desc, $value);
            if($counter >= 5){
                break;
            }else{
                $counter++;
            }
        }

        $data = [
            'name'=>$temp_products,
            'qty'=>$temp_qty,
            'name_desc'=>$temp_products_desc,
            'qty_desc'=>$temp_qty_desc

        ];

        return $data;
    }
}
