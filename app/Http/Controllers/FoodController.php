<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FoodModel;

class FoodController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:admin');
    }

        public function ListFoodTypes()
        {
            $foods = FoodModel::orderby('id','desc')->get();
            return view('admin.food.list', compact('foods'));
        }

        public function AddFoodTypes()
        {
            return view('admin.food.add');
        }

        public function SaveFoodTypes(Request $request)
        {
            $Food = new FoodModel;
            $Food->min_age = $request->min_age;
            $Food->max_age = $request->max_age;
            $Food->memberType = $request->memberType;
            $Food->food_type = $request->food_type;
            $Food->price = $request->price;
            $Food->save();
           return redirect()->back()->withSuccess('Food Type Added Successfully');

        }

        public function EditFoodTypes($id)
        {
            $food = FoodModel::where('id',$id)->first();
            return view('admin.food.edit',compact('food'));
        }

        public function UpdateFoodTypes(Request $request)
        {
            $Food = FoodModel::find($request->FoodId);
             $Food->min_age = $request->min_age;
            $Food->max_age = $request->max_age;
            $Food->memberType = $request->memberType;
            $Food->food_type = $request->food_type;
            $Food->price = $request->price;
            $Food->save();
            $Food->save();
               
            return redirect(route('admin.food.list'));
        }


        public function DeleteFoodTypes(Request $request)
        {
            $food = FoodModel::find($request->FoodId);

            if($food->delete()){
            return redirect(route('admin.food.list'))->withSuccess('food Removed Successfully');


            }else{
                return redirect(route('admin.food.list'))->withSuccess('food Removed Successfully');

            }
        }
}
