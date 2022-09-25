<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SellExport;
use App\Exports\DueSellExport;
use App\Exports\CustomersPurchase;
use App\Exports\PurchaseExport;
use App\Exports\ExpancesExport;
use App\Exports\RefundExport;
use App\Exports\ProfitExport;
use App\Exports\CustomerListExport;
use App\Exports\SupplierListExport;

class ReportController extends Controller
{
    public function SellsReport(Request $req)
    {
        if ($req->isMethod('post'))
        {
            $tempFrom = $req->input('from');
            $tempTo   = $req->input('to');

            $from = date('Y-m-d', strtotime($tempFrom. ' - 1 days'));
            $to   = date('Y-m-d', strtotime($tempTo. ' + 1 days'));

            if($req->has('exportExcel'))
             {           
                // select Excel
                return Excel::download(new SellExport($from, $to), 'Excel-Sells_Report.xls');
            } 
        }
    }


    public function DueSellsReport(Request $req)
    {
        if ($req->isMethod('post'))
        {
            $tempFrom = $req->input('from');
            $tempTo   = $req->input('to');

            $from = date('Y-m-d', strtotime($tempFrom. ' - 1 days'));
            $to   = date('Y-m-d', strtotime($tempTo. ' + 1 days'));

            if($req->has('exportExcel'))
             {           
                // select Excel
                return Excel::download(new DueSellExport($from, $to), 'Excel-Due_Sells_Report.xls');
            } 
        }
    }


    public function CustomersPurchaseReport(Request $req)
    {
        $method = $req->method();

        // echo "<pre>";
        // print_r($req->all());
        // exit();

        if ($req->customer_id != "") {

            if ($req->isMethod('post'))
            {
                $tempFrom = $req->input('from');
                $tempTo   = $req->input('to');

                $from = date('Y-m-d', strtotime($tempFrom. ' - 1 days'));
                $to   = date('Y-m-d', strtotime($tempTo. ' + 1 days'));
                $name = $req->customer_id;

                if($req->has('exportExcel'))
                 {           
                    // select Excel
                    return Excel::download(new CustomersPurchase($from, $to,$name), 'Excel-customers_purchase_report.xlsx');
                } 
            }
        } 
    }

    public function PurchaseReport(Request $req)
    {
        if ($req->isMethod('post'))
        {
            $tempFrom = $req->input('from');
            $tempTo   = $req->input('to');

            $from = date('Y-m-d', strtotime($tempFrom. ' - 1 days'));
            $to   = date('Y-m-d', strtotime($tempTo. ' + 1 days'));

            if($req->has('exportExcel'))
             {           
                // select Excel
                return Excel::download(new PurchaseExport($from, $to), 'Excel-Purchase_Report.xls');
            } 
        }
    }


    public function ExpensesReport(Request $req)
    {
        if ($req->isMethod('post'))
        {
            $tempFrom = $req->input('from');
            $tempTo   = $req->input('to');

            $from = date('Y-m-d', strtotime($tempFrom. ' - 1 days'));
            $to   = date('Y-m-d', strtotime($tempTo. ' + 1 days'));

            if($req->has('exportExcel'))
             {           
                // select Excel
                return Excel::download(new ExpancesExport($from, $to), 'Excel-Expenses_Report.xls');
            } 
        }
    }

    public function RefundsReport(Request $req)
    {
        if ($req->isMethod('post'))
        {
            $tempFrom = $req->input('from');
            $tempTo   = $req->input('to');

            $from = date('Y-m-d', strtotime($tempFrom. ' - 1 days'));
            $to   = date('Y-m-d', strtotime($tempTo. ' + 1 days'));

            if($req->has('exportExcel'))
             {           
                // select Excel
                return Excel::download(new RefundExport($from, $to), 'Excel-Refunds_Report.xls');
            } 
        }
    }

    public function ProfitsReport(Request $req)
    {
        if ($req->isMethod('post'))
        {
            $tempFrom = $req->input('from');
            $tempTo   = $req->input('to');

            $from = date('Y-m-d', strtotime($tempFrom. ' - 1 days'));
            $to   = date('Y-m-d', strtotime($tempTo. ' + 1 days'));

            if($req->has('exportExcel'))
             {           
                // select Excel
                return Excel::download(new ProfitExport($from, $to), 'Excel-Profits_Report.xls');
            } 
        }
    }

    public function CustomersList(Request $req)
    {
        
        return Excel::download(new CustomerListExport, 'Excel-Customer_List.xls');
    }

    public function SuppliersList(Request $req)
    {
        
        return Excel::download(new SupplierListExport, 'Excel-Suppliers_List.xls');
    }

}
