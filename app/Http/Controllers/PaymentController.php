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
        $request->all();

        $amount = $request->input('amount');
        $nonce = $request->input('payment_method_nonce');
        $name = $request->input('name');
        $surname = $request->input('surname');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $cart = $request->input('cart');
        $restaurant_name = $request->input('restaurant_name');

        $result = $this->gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true,
            ],
        ]);

        if ($result->success) {
            $this->sendEmail($name, $surname, $email, $phone, $address, $cart, $restaurant_name ,$amount, $result->transaction->id);
            return response()->json(['success' => true, 'transaction_id' => $result->transaction->id]);
        } else {
            return response()->json(['success' => false, 'message' => $result->message]);
        }
    }

    protected function sendEmail($name, $surname, $email, $phone, $address, $cart, $restaurant_name,$amount, $transactionId)
    {
        $data = [
            'name' => $name,
            'surname' => $surname,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'cart' => $cart,
            'resturant_name' => $restaurant_name,
            'amount' => $amount,
            'transactionId' => $transactionId,
        ];

        Mail::send('emails.user', $data, function ($message) use ($email) {
            $message->to($email)
                    ->subject('Pagamento Ricevuto');
        });

        Mail::send('emails.resturant', $data, function ($message ) use ($restaurant_name) {
            $message->to($restaurant_name+'@gmail.com')
                ->subject('Nuovo Pagamento Ricevuto');
        });
    }
}
