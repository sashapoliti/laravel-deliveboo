<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Braintree\Gateway;

class PaymentController extends Controller
{
    protected $gateway;

    public function __construct(Gateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function getToken()
    {
        $clientToken = $this->gateway->clientToken()->generate();
        return response()->json(['clientToken' => $clientToken]);
    }

    public function processPayment(Request $request)
    {
        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;
        $name = $request->name;
        $surname = $request->surname;
        $email = $request->email;

        $result = $this->gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true,
            ],
        ]);

        if ($result->success) {
            $this->sendEmail($name, $surname, $email, $amount, $result->transaction->id);
            return response()->json(['success' => true, 'transaction_id' => $result->transaction->id]);
        } else {
            return response()->json(['success' => false, 'message' => $result->message]);
        }
    }

    protected function sendEmail($name, $surname, $email, $amount, $transactionId)
    {
        $data = [
            'name' => $name,
            'surname' => $surname,
            'email' => $email,
            'amount' => $amount,
            'transactionId' => $transactionId,
        ];

        Mail::send('emails.receipt', $data, function ($message) use ($email) {
            $message->to($email)
                    ->subject('Pagamento Ricevuto');
        });
    }
}



