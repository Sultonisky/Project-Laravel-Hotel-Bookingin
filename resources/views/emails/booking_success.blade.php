<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation - Bookingin</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f4f8fb; color: #222; margin:0; padding:0;">
    <div style="max-width:520px;margin:32px auto;background:#fff;border-radius:12px;box-shadow:0 2px 16px #024aff22;padding:0;overflow:hidden;">
        <!-- Header -->
        <div style="background:linear-gradient(90deg,#024aff 0%,#007bff 100%);padding:24px 0;text-align:center;">
            <img src="{{ asset('backend/images/logo-putih.png') }}" alt="Bookingin Logo" style="height:38px;margin-bottom:8px;">
            <h2 style="color:#fff;margin:0;font-size:1.5rem;letter-spacing:1px;">Booking Confirmed!</h2>
        </div>
        <div style="padding:32px 28px 24px 28px;">
            <p style="font-size:1.1rem; margin-bottom: 0.5rem;">Dear <strong>{{ $reservation->guest->name }}</strong>,</p>
            <p style="margin:0 0 0.5rem 0;">Welcome to <strong>Bookingin</strong>!</p>
            <p style="margin-bottom:18px;">We are delighted to inform you that your reservation has been <span style="color:#024aff;font-weight:bold;">successfully confirmed</span>. Here are your booking details:</p>
            <table style="width:100%;font-size:1rem;margin-bottom:18px;">
                <tr>
                    <td style="padding:6px 0;color:#888;">Booking Code</td>
                    <td style="padding:6px 0;font-weight:bold;color:#024aff;">{{ $reservation->booking_code }}</td>
                </tr>
                <tr>
                    <td style="padding:6px 0;color:#888;">Guest Name</td>
                    <td style="padding:6px 0;">{{ $reservation->guest->name }}</td>
                </tr>
                <tr>
                    <td style="padding:6px 0;color:#888;">Email</td>
                    <td style="padding:6px 0;">{{ $reservation->guest->email }}</td>
                </tr>
                <tr>
                    <td style="padding:6px 0;color:#888;">Check-in</td>
                    <td style="padding:6px 0;">{{ $reservation->checkin_date }}</td>
                </tr>
                <tr>
                    <td style="padding:6px 0;color:#888;">Check-out</td>
                    <td style="padding:6px 0;">{{ $reservation->checkout_date }}</td>
                </tr>
                <tr>
                    <td style="padding:6px 0;color:#888;">Room</td>
                    <td style="padding:6px 0;">{{ $reservation->room->room_name }} ({{ $reservation->room->category->category_name }})</td>
                </tr>
                <tr>
                    <td style="padding:6px 0;color:#888;">Total Payment</td>
                    <td style="padding:6px 0;font-weight:bold;">IDR {{ number_format($reservation->total_payment, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td style="padding:6px 0;color:#888;">Payment Method</td>
                    <td style="padding:6px 0;">
                        @if($reservation->payment_method == 1)
                            Bank Transfer
                        @elseif($reservation->payment_method == 0)
                            Credit Card
                        @elseif($reservation->payment_method == 2)
                            e-Wallet
                        @else
                            -
                        @endif
                    </td>
                </tr>
            </table>
            <div style="background:#f4f8fb;border-radius:8px;padding:16px 18px;margin-bottom:18px;">
                <strong>Check-in Instructions:</strong>
                <ul style="margin:8px 0 0 18px;padding:0;font-size:0.97rem;">
                    <li>Please present this booking code at the front desk upon arrival.</li>
                    <li>Check-in is available from 2:00 PM, and check-out is until 12:00 PM.</li>
                    <li>If you need any assistance, feel free to contact us below.</li>
                </ul>
            </div>
            <div style="margin-bottom:18px;">
                <strong>Need help?</strong><br>
                <span style="color:#024aff;">WhatsApp:</span> <a href="https://wa.me/6281234567890" style="color:#007bff;text-decoration:none;">+62 812-3456-7890</a><br>
                <span style="color:#024aff;">Email:</span> <a href="mailto:info@bookingin.com" style="color:#007bff;text-decoration:none;">info@bookingin.com</a>
            </div>
            <p style="margin-bottom:2.5rem;">Thank you for choosing <strong>Bookingin</strong>.<br>We look forward to welcoming you and wish you a pleasant stay!</p>
            <div style="margin-top: 2.5rem;">
                <p style="margin:0;font-size:1rem;">Best regards,</p>
                <p style="margin:0;font-weight:bold;color:#024aff;">Bookingin Team</p>
            </div>
        </div>
        <div style="background:#f4f8fb;text-align:center;padding:16px 0 8px 0;font-size:0.95rem;color:#888;">
            &copy; {{ date('Y') }} Bookingin. All rights reserved.
        </div>
    </div>
</body>
</html> 