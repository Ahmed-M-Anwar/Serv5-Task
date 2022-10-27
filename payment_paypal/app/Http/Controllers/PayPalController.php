<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\Models\History;
use Illuminate\Support\Facades\DB;

class PayPalController extends Controller
{
    public function goPayment(){
          return view('product.welcome');
    }
    public function payment(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|max:6',
        ]);

        $data = [];
        $data['items'] = [
            [
                'name' => 'Apple',
                'price' => $request->amount,
                'desc'  => 'Macbook pro 14 inch',
                'qty' => 1
            ]
        ];

        $data['invoice_id'] = 1;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');
        $data['total'] = $request->amount;

        $provider = new ExpressCheckout;

        $response = $provider->setExpressCheckout($data);

        $response = $provider->setExpressCheckout($data, true);

        History::create([
            'amount' => $request->amount,
            'currency' => 'usd',
        ]);
        //DB::insert('insert into histories (amount, currency) values (?, ?)', [$request->amount, 'usd']);

        return redirect($response['paypal_link']);
    }

    public function cancel()
    {
        dd('Your payment is canceled.');
    }

   public function success(Request $request)
    {
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            dd('Your payment was successfully.');
        }

        dd('Please try again later.');
    }
}
