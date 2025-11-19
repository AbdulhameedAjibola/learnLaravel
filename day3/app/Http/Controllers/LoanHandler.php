<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\User;

class LoanHandler extends Controller
{
    public function index(){
        $hasRepayments = Loan::whereHas('repayments')->with('repayments')->get();

        return response()->json($hasRepayments);
    }

    public function store(Request $request){
        $data = $request->all();

        $loan = Loan::create($data);

        return response()->json($loan, 201);
    }

    public function update(Request $request, $id){
        $loan = Loan::find($id);

        if(!$loan){
            return response()->json(['message' => 'Loan not found'], 404);
        }

        $data = $request->only([
            
            'monthly_installment',
            'outstanding_balance',
            
        ]);
        $loan->update($data);

        return response()->json($loan);
    }

    public function destroy($id){
        $loan = Loan::find($id);

        if(!$loan){
            return response()->json(['message' => 'Loan not found'], 404);
        }

        $loan->delete();

        return response()->json(['message' => 'Loan deleted successfully']);
    }


}
