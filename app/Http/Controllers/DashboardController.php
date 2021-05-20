<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\TransactionModel;


class DashboardController extends Controller
{
    function CountSummary(){
        $totalProduct      =  ProductModel::count();
        $totalCategory     =  CategoryModel::count();
        $totalTransaction  =  TransactionModel::count();
        $totalEarning      =  TransactionModel::sum('product_total_price');
        return [
            'products'=>$totalProduct, 
            'categories'=>$totalCategory,
            'transactions'=>$totalTransaction,
            'earnings'=>$totalEarning,
        ];
    }

    function RecentTransactionList(){
        $result=  TransactionModel::orderBy('id','desc')->limit(20)->get();
        return  $result;
    }

    function IncomeLast7Days(){

        date_default_timezone_set('Asia/Dhaka');

        // Day 1
        $myDate1 = date('d/m/Y');
        $TotalIncome1= TransactionModel::where('invoice_date',$myDate1)->sum('product_total_price');

        // Day 2
        $myDate2 = date("d/m/Y", strtotime("-1 day"));
        $TotalIncome2= TransactionModel::where('invoice_date',$myDate2)->sum('product_total_price');

        // Day 3
        $myDate3 = date("d/m/Y", strtotime("-2 day"));
        $TotalIncome3= TransactionModel::where('invoice_date',$myDate3)->sum('product_total_price');

        // Day 4
        $myDate4 = date("d/m/Y", strtotime("-3 day"));
        $TotalIncome4= TransactionModel::where('invoice_date',$myDate4)->sum('product_total_price');

        // Day 5
        $myDate5 = date("d/m/Y", strtotime("-4 day"));
        $TotalIncome5= TransactionModel::where('invoice_date',$myDate5)->sum('product_total_price');

        // Day 6
        $myDate6 = date("d/m/Y", strtotime("-5 day"));
        $TotalIncome6 = TransactionModel::where('invoice_date',$myDate6)->sum('product_total_price');

        // Day 7
        $myDate7 = date("d/m/Y", strtotime("-6 day"));
        $TotalIncome7 = TransactionModel::where('invoice_date',$myDate7)->sum('product_total_price');

        $arr = array(
            array(
                "t_date" => $myDate1,
                "income" => $TotalIncome1
            ),
            array(
                "t_date" => $myDate2,
                "income" => $TotalIncome2
            ),
            array(
                "t_date" => $myDate3,
                "income" => $TotalIncome3
            ),
            array(
                "t_date" => $myDate4,
                "income" => $TotalIncome4
            ),
            array(
                "t_date" => $myDate5,
                "income" => $TotalIncome5
            ),
            array(
                "t_date" => $myDate6,
                "income" => $TotalIncome6
            ),
            array(
                "t_date" => $myDate7,
                "income" => $TotalIncome7
            )
        );

        return $arr;
    }

}
