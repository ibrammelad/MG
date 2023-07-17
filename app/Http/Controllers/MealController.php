<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Meal;
use Illuminate\Http\Request;

class MealController extends Controller
{
    public function menuItems()
    {
        $meals = Meal::selection()->where('quantity_available', '>', 0)
            ->simplePaginate(15);
        return response()->json(['data' =>$meals, 'status'=>200]);
    }
}
