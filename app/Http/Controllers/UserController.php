<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Hash;

class UserController extends Controller
{

    function AddUser(Request $request){
       $name= $request->input('name');
       $username= $request->input('username');
       $password= Hash::make($request->input('password'));
       $roll= $request->input('roll');
       $userCount= UserModel::Where('username',$username)->count();
       if ($userCount>0){
            return "Username already exists";
       }
       else{
          $result= UserModel::insert(["fullname"=>$name, "username"=>$username, "roll"=>$roll, "lastactivity"=>"No Activity", "password"=>$password]);
          return $result;
       }
    }

    function DeleteUser(Request $request){
        $id= $request->id;
        $result=UserModel::Where('id', $id)->delete();
        return  $result;
    }

    function SelectUser(){
        $result=UserModel::all();
        return  $result;
    }
    function UpdateUser(Request $request){
        $id= $request->input('id');
        $name= $request->input('name');
        $username= $request->input('username');
        $password= Hash::make($request->input('password'));
        $roll= $request->input('roll');
        $currentUser= UserModel::Where('username',$username)->where('id',$id)->count();
        $userCount= UserModel::Where('username',$username)->count();
           if($currentUser===1 || $userCount===0)
           {
              $result= UserModel::Where('id',$id)->update(["fullname"=>$name, "username"=>$username, "roll"=>$roll, "lastactivity"=>"No Activity", "password"=>$password]);
              return $result;
           }
           else{
            return "Username already exists";
           }
        
    }
}
