<?php

namespace App\Http\Controllers;
use App\Models\Loan;
use App\Models\User;
use App\Models\Repayment;

use Illuminate\Http\Request;

class LoanRepaymentController extends Controller
{
    
      public function createRepayment(Request $request, $loan_id){

        $data = $request -> validate([
            'instalment_amount' => 'required|numeric',
            'payment_status' => 'required|in: paid, processing, failed'
        ]);

        $loan = Loan::find($loan_id);

        if(!$loan){
            return response()-> json(['message' => 'Loan not found'], 404);
        };

        $repayment = Repayment::create([
            'loan_id' => $loan->id,
            'instalment_amount' => $data['installment_amount'],
            'remaining_balance' => $loan->outstanding_balance - $data['instalment_amount'],
            'payment_date' => now(),
            'payment_status' => $data['payment_status']

        ]);
        $loan->outstanding_balance -= $data['instalment_amount'];
        $loan->save();

        return response()-> json([
            'repayment' => $repayment,
            'loan' => $loan->fresh(),
            'msg' => "Repayment created successfully"
        ]);

    }

    public function index(){
        $repayments = Repayment::all();
        return response()->json($repayments);
    }
    
    public function updateRepayment(Request $request, $id){
        $repayment = Repayment::find($id);

        if(!$repayment){
            return response()->json(['message' => 'Repayment does not exist'], 404);
        }

        $data = $request->only([
            'installment_amount',
            'payment_status',
            
        ]);

        $loan = $repayment->loan;

        if(!$loan){
            return response()->json(['message'=> 'Loan not found'], 404);
        }

        $loan->outstanding_balance -= $data['installment_amount'];
        $loan->save();
        $updatedLoan = $loan->fresh();

        $repayment->update([
            'installment_amount' => $data['installment_amount'],
            'payment_status' => $data['payment_status']
        ]);

        return response()-> json([
            'repayment' => $repayment,
            'loan' => $updatedLoan,
            'msg' => "repayment successful"
        ]);
    }

    public function destroy($id){
        $repayment = Repayment::find($id);

        if(!$repayment){
            return response()-> json(['msg' => 'Repayment invalid'], 404);
        }

        $repayment->delete();
        return response()-> json(['msg' => 'Repayment deleted successfully']);
    }

  
}
