<?php

namespace App\Http\Controllers;

use App\Models\Lottery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LotteryController extends Controller
{
    public function index()
    {
       return view('lottery');
    }
    public function store(Request $request)
    {
        $numbers = $request->input('numbers');
        if (is_array($numbers) && count($numbers) == 15) {
            $lottery = new Lottery();
            for ($i = 1; $i <= 15; $i++) {
                $lottery->{"number_$i"} = $numbers[$i - 1];
            }
            $lottery->user_id = Auth::id();
            $lottery->save();

            return response()->json('Escolhas de loteria salvas com sucesso!', 200);
        } else {
            return response()->json('Invalid numbers', 400);
        }
    }


}
