<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use App\Models\TransactionModel;
use Illuminate\Http\Request;
use DB;
class TransactionController extends Controller
{

    function CartSale(Request $request){
        $user_id=$request->user_id;
        $CartList=CartModel::Where('user_id',$user_id)->get();
        $cartInsertDeleteResult="";
        $user = '';
        $user_name = DB::table('cart_list')
                    ->join('user_list', 'cart_list.user_id', 'user_list.id')
                    ->get('user_list.fullname');
                    foreach($user_name as $name)
                    {
                         $user = $name->fullname;
                    }
            foreach($CartList as $CartListItem) {
            $resultInsert=  TransactionModel::insert([
                "invoice_no"=>$CartListItem['invoice_no'],
                "invoice_date"=>$CartListItem['invoice_date'],
                "product_name"=>$CartListItem['product_name'],
                "product_qty"=>$CartListItem['product_qty'],
                "product_unit_price"=>$CartListItem['product_unit_price'],
                "product_total_price"=>$CartListItem['product_total_price'],
                "seller_name"=>$CartListItem['seller_name'],
                "user_name"=>$user,
                "product_icon"=>$CartListItem['product_icon'],
            ]);

        }
        CartModel::Where('user_id',$user_id)->delete();

        return $resultInsert;
    }


}
