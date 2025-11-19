<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanPractice;

class LoanPracticeController extends Controller
{
    //
    public function show(){

        $loans = LoanPractice::all();

        return response()->json($loans);
    }
}
