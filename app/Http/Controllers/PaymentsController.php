<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Schema;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentsController extends Controller
{
    /*public function form(Order $order)
    {
        return view('payments.form', [
            'order' => $order,
        ]);
    }*/

    public function callback(Schema $schema)
    {
        /*$text = 'line 1
line 2 with numbers
0566546621
0598124545
email@domnain.com';

        $lines = explode("\n", $text);
        foreach ($lines as $i => $line) {
            if (preg_match('/^[a-z-A-Z0-9\._]+@[a-z-A-Z0-9\._]+$/', $line)) {
                echo ($i+1) . ': ' .$line;
            }

            if (preg_match('/^05(6|9)[0-9]{7}$/', $line)) {
                echo ($i+1) . ': ' .$line;
            }
        }

        exit;*/

        // dd(request()->all());
        $id = request()->query('id');

        $token = base64_encode(config('services.moyasar.secret') . ':');

        $payment = Http::baseUrl('https://api.moyasar.com/v1')
            /*->withHeaders([
                'Authorization' => "Basic {$token}",
                'Content-Type' => 'application/json',
                'x-api-key' => '',
            ])*/
            ->withBasicAuth(config('services.moyasar.secret'), '')
            ->get("payments/{$id}")
            ->json();

        if (isset($payment['type']) && $payment['type'] == 'invalid_request_error') {
            return redirect()->route('landing-page')->with('error', $payment['message']);
        }

        if ($payment['status'] == 'paid') {
            $tenant = Tenant::where('id', request()->tenant_id)->first();
            $tenant->expire = now()->addMonth();
            $tenant->save();

            $capture = Http::baseUrl('https://api.moyasar.com/v1')
                ->withHeaders([
                    'Authorization' => "Basic {$token}",
                ])
                ->post("payments/{$id}/capture")
                ->json();
            
         
                 return redirect()->away("http://{$tenant->tenant_id}.limsstage.com")
                    ->with("success", __('general.added_successfully'));
 
        }

    }
}