<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\Payment;

class PaypalController extends Controller
{

    ////////////////////////////////////////
    //PAYPAL
    public function paypal(Request $request)
    {
        //Creo instancia del cliente de Paypal
        $provider = new PayPalClient;
        // Configuro las credenciales de paypal
        $provider->setApiCredentials(config('paypal'));
        // Obtengo token de acceso de paypal
        $paypalToken = $provider->getAccessToken();

        // Guarda los datos del producto en la sesión
        session()->put('product_name', $request->product_name);
        session()->put('quantity', $request->quantity);

        // Creo una orden de pago en Paypalc on los detalles del producto
        $response = $provider->createOrder([
            "intent" => "CAPTURE", 
            "application_context" => [
                "return_url" => route('success'),
                'cancel_url' => route('cancel')
            ],
            "purchase_units" => [ // Informacion del producto
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $request->price
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        } else {
            // Redirige a la ruta cancel solo si no se encontró un enlace "approve"
            return redirect()->route('cancel');
        }
    }


    public function success(Request $request)
    {
        // Creo instancia del cliente de paypal
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        // capturo el pago de la orden usando el token proporcionado
        $response = $provider->capturePaymentOrder($request->token);

        // En el caso de que  el estado es completed
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            $product_name = session()->get('product_name');
            $quantity = session()->get('quantity');

            // Guardo los datos de la compra en la bbdd
            $payment = new Payment;

            $payment->payment_id = $response['id'];
            $payment->product_name = $product_name;
            $payment->quantity = $quantity;            
            $payment->amount = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
            $payment->currency = $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'];
            $payment->payer_name = $response['payer']['name']['given_name'] . ' ' . $response['payer']['name']['surname'];
            $payment->payer_email = $response['payer']['email_address'];
            $payment->payment_status = $response['status'];
            $payment->payment_method = "Paypal";

            $payment->save();

            // Elimina el nombre del producto de la sesión
            // session()->forget($product_name);
            
            return redirect()->route('cart.listar');
        } else {
            return redirect()->route('cancel');
        }
    }

    public function cancel()
    {
        return "Payment is cancelled";
    }
}
