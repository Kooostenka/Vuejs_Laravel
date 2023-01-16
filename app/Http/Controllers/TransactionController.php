<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function index(Request $request){

        if ($request->search){
            $transactions = Transaction::with('user')->where('user_id', 'like', '%' . $request->search .'%')->get();
        }

//        if ($request->range){
//            $range=$request->get('range');
//            $start1 = $range['start'];
//            $end = $range['end'];
//            $start=Carbon::parse($start1)->timezone(config('app.timezone'));
//            return response()->json(['start'=>$start->format('Y-m-d h:m:s'), 'start1'=>$start1]);
//        }

        if(!$request->search && !$request->range) {
            $transactions = Transaction::with('user')->get();
        }

        $total_amount = $transactions->sum('sum');
        return response()->json(['transactions'=> TransactionResource::collection($transactions), 'total_amount' => $total_amount]);
    }

    public function store(Request $request){
        $data = $request->validate([
            'sum' => 'required|numeric|gt:0',
            'user_id' => 'required|exists:users,id',
        ]);
        $transaction = Transaction::firstOrCreate($data);
        return response()->json([$transaction]);

    }

    public function destroy(Transaction $transaction){
        $transaction->delete();
    }

}
