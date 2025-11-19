<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoanHandler extends Controller
{
    public function index(){
       $owingUser = User::with(['repayments'])->get();
         return response()->json($owingUser);

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
