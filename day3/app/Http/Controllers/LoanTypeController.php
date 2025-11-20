<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\User;
use App\Models\Repayment;
use App\Models\LoanType;


class LoanTypeController extends Controller
{
    public function index(){
        $loan_types = LoanType::all();
        return response()-> json($loan_types);
    }

    public function show($id){
        $loan_type = LoanType::find($id);

        if(!$loan_type){
            return response()-> json(['message' => 'Loan type not found'], 404);
        }

        return response()-> json($loan_type);
    }

    public function createLoanType(Request $request){
        $data = $request->validate([
            'loan_name' => 'required|string',
            'duration' => 'required|string',
            'interest_rate' => 'required|numeric',
            'max_amount' => 'required|numeric',
        ]);

        $loan_type = LoanType::create($data);

        return response()-> json($loan_type, 201);
    }

    public function updateLoanType(Request $request, $id){
        $loan_type = LoanType::find($id);

        if(!$loan_type){
            return response() -> json(['message' => "Loan Type not found"], 404);
        }

        $data = $request ->validate([
            'duration' => 'required|string',
            'interest_rate' => 'required|numeric',
        ]);

        $loan_type->update($data);

        return response()->json($loan_type);
    }

    public function deleteLoanType($id){
        $loan_type = LoanType::find($id);

        if(!$loan_type){
            return response()-> json(['message' => 'Loan type not found'], 404);
        }

        $loan_type->delete();

        return response()->json(['msg' => 'Loan type deleted successfully']);
    }
}
