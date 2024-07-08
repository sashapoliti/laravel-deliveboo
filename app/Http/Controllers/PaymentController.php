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
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'payment_method_nonce' => 'required|string',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        $amount = $request->input('amount');
        $nonce = $request->input('payment_method_nonce');
        $name = $request->input('name');
        $surname = $request->input('surname');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $address = $request->input('address');

        $result = $this->gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true,
            ],
        ]);

        if ($result->success) {
            $this->sendEmail($name, $surname, $email, $phone, $address, $amount, $result->transaction->id);
            return response()->json(['success' => true, 'transaction_id' => $result->transaction->id]);
        } else {
            return response()->json(['success' => false, 'message' => $result->message]);
        }
    }

    protected function sendEmail($name, $surname, $email, $phone, $address, $amount, $transactionId)
    {
        $data = [
            'name' => $name,
            'surname' => $surname,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'amount' => $amount,
            'transactionId' => $transactionId,
        ];

        Mail::send('emails.receipt', $data, function ($message) use ($email) {
            $message->to($email)
                    ->subject('Pagamento Ricevuto');
        });
    }
}
