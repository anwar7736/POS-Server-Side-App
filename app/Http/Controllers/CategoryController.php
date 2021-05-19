<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

    function AddCategory(Request $request){
       $name= $request->input('name');
       $image = $request->file('image');
       $cat_code= time();
       $countCat=CategoryModel::Where('cat_name',$name)->count();
       if($countCat > 0)
       {
            return "Category name already exists";
       }
       else{
        $imagePath= $image->store('public');
        $result= CategoryModel::insert(['cat_name'=>$name, 'cat_code'=>$cat_code, 'cat_icon'=>$imagePath]);
        return $result;
       }
       
    }

    function DeleteCategory(Request $request){
        $id= $request->id;
        $cat_icon= CategoryModel::Where('id',$id)->get(['cat_icon']);
        Storage::delete($cat_icon[0]['cat_icon']);
        $result=CategoryModel::Where('id', $id)->delete();
        return  $result;
    }

    function SelectCategory(){
        $result= CategoryModel::all();
        return $result;
    }


    function UpdateCategory(Request $request){
        $id= $request->input('id');
        $name= $request->input('name');
        $image= $request->file('image');
        $currentCat= CategoryModel::Where('cat_name',$name)->where('id',$id)->count();
        $catCount= CategoryModel::Where('cat_name',$name)->count();
           if($currentCat===1 || $catCount===0)
           {
              if(empty($image))
              {
                  $result= CategoryModel::Where('id', $id)->update(['cat_name'=>$name]);
                  return $result;
              }
              else{
                 $cat_icon= CategoryModel::Where('id',$id)->get(['cat_icon']);
                 Storage::delete($cat_icon[0]['cat_icon']);
                 $imagePath= $image->store('public');
                 $result= CategoryModel::Where('id', $id)->update(['cat_name'=>$name,'cat_icon'=>$imagePath]);
                 return $result;
              }
           }
           else{
             return "Category name already exists";
           }


    }

}
