<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Mail\BookingSuccessMail;
use Illuminate\Support\Facades\Mail;

class MidtransWebhookController extends Controller
{
    public function handle(Request $request)
    {
        // Untuk debugging (sementara)
        Log::info('Midtrans Webhook Received', $request->all());

        $serverKey = config('midtrans.server_key');
        $signatureKey = $request->signature_key;
        $orderId = $request->order_id;
        $statusCode = $request->status_code;
        $grossAmount = $request->gross_amount;

        // Validasi Signature
        $expectedSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);
        if ($signatureKey !== $expectedSignature) {
            Log::warning('Invalid Signature Key from Midtrans');
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // Update status reservasi berdasarkan status Midtrans
        $reservation = Reservation::where('booking_code', $orderId)->first();

        if (!$reservation) {
            Log::warning('Reservation not found for order_id ' . $orderId);
            return response()->json(['message' => 'Reservation not found'], 404);
        }

        switch ($request->transaction_status) {
            case 'capture':
            case 'settlement':
                $wasSuccess = $reservation->status === 'success';
                $reservation->status = 'success';
                $reservation->save();
                // Kirim email hanya jika status sebelumnya bukan success
                if (!$wasSuccess) {
                    Mail::to($reservation->guest->email)->send(new BookingSuccessMail($reservation));
                }
                break;

            case 'pending':
                $reservation->status = 'pending';
                break;

            case 'deny':
            case 'cancel':
            case 'expire':
                $reservation->status = 'canceled';
                break;
        }

        if ($request->transaction_status !== 'capture' && $request->transaction_status !== 'settlement') {
            $reservation->save();
        }

        return response()->json(['message' => 'Webhook handled'], 200);
    }
}
