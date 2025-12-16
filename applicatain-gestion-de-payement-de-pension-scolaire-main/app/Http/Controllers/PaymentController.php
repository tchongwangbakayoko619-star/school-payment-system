<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class PaymentController extends Controller
{
    public function initiatePayment(Request $request)
    {
        // Validate the request data
        $request->validate([
            'amount' => 'required|numeric',
            'currency' => 'required|string',
        ]);

        // Prepare payment data
        $paymentData = [
            'amount' => $request->amount,
            'currency' => $request->currency,
            'transaction_id' => uniqid('txn_'),
            // Add other necessary payment parameters here
        ];

        // Redirect to CinetPay payment page
        return redirect()->route('cinetpay.redirect', $paymentData);
    }

    public function paymentSuccess(Request $request)
    {
        // Handle successful payment
        $transaction = new Transaction();
        $transaction->transaction_id = $request->cpm_trans_id;
        $transaction->amount = $request->cpm_amount;
        $transaction->currency = $request->cpm_currency;
        $transaction->status = 'success';
        $transaction->save();

        return view('payments.success', ['transaction' => $transaction]);
    }

    public function paymentFailure(Request $request)
    {
        // Handle failed payment
        return view('payments.failure', ['message' => $request->cpm_message]);
    }
}