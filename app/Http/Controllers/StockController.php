<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StockController extends Controller
{
    public function stockdetails()
    {
        return view('stock.stockdetails');
    }
    public function stockpurchase()
    {
        return view('stock.stockpurchase');
    }
    public function stockreturn()
    {
        return view('stock.stockreturn');
    }
    public function stockusage()
    {
        return view('stock.stockusage');
    }
    public function returndetails()
    {
        return view('stock.returndetails');
    }
    // public function studentdetails()
    // {
    //     return view('stock.studentdetails');
    // }
}
