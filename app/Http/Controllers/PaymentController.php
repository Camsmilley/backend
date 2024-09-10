<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $validatedData = $request->validate([
            'data.id' => 'required|string',
            'data.attributes.type' => 'required|string',
            'data.attributes.data' => 'required|array',
        ]);

        $event = Payment::create([
            'event_id'      => $validatedData['data']['id'],
            'event_type'    => $validatedData['data']['attributes']['type'],
            'payload'       => json_encode($validatedData['data']['attributes']['data']),
            'payload_id'    => $validatedData['data']['attributes']['data']['id'],
        ]);

        if($event){
            if($validatedData['data']['attributes']['type'] == "payment.paid"){
                $booking = Booking::where('id', $validatedData['data']['attributes']['data']['attributes']['description'])->first();
                if($booking){
                    $booking->update([
                        'status' =>'confirmed'
                    ]);
                }
            }

            if($validatedData['data']['attributes']['type'] == "payment.failed"){
                $booking = Booking::where('id', $validatedData['data']['attributes']['data']['attributes']['description'])->first();
                if($booking){
                    $booking->update([
                        'status' =>'pending'
                    ]);
                }
            }
        }

        return response()->json(['message' => 'Webhook received and processed'], 200);
    }
}
