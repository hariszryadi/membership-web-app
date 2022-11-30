<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function store(Request $request) {

        $check = Transaction::where('user_id', $request->user_id)->first();
        if ($check != null) {
            return redirect()->back();
        }

        Transaction::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id
        ]);

        return redirect()->back();
    }
}
