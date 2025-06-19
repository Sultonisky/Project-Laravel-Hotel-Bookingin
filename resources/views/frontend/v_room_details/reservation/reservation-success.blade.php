<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Payment Success</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" />
    <style>
        body {
            background-color: #000;
            font-family: "Roboto", sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            background-color: #111;
            color: white;
            padding: 40px;
            border-radius: 20px;
            width: 350px;
            text-align: center;
            border: 1px solid #fff;
        }

        .check-icon {
            width: 80px;
            height: 80px;
            background-color: #00ff88;
            border-radius: 50%;
            border: 3px solid #fff;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .check-icon::before {
            content: "✔";
            color: #fff;
            font-size: 36px;
            font-weight: bold;
        }

        .amount {
            font-size: 25px;
            font-weight: bold;
            margin-top: 5px;
            margin-bottom: 35px;
        }

        .label {
            text-align: left;
            color: #aaa;
            font-size: 16px;
        }

        .value {
            text-align: right;
            font-weight: bold;
            color: white;
            font-size: 16px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
        }

        .btn {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 12px;
            width: 100%;
            font-size: 16px;
            border-radius: 12px;
            cursor: pointer;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="check-icon"></div>
        <div>Payment Success</div>
        <div class="amount">IDR {{ number_format($booking->total_payment, 0, ',', '.') }}</div>

        <div class="row">
            <div class="label">BOOKING CODE</div>
            <div class="value">{{ $booking->booking_code ?? '-' }}</div>
        </div>

        <div class="row">
            <div class="label">NAME</div>
            <div class="value">{{ $booking->guest->name }}</div>
        </div>

        <div class="row">
            <div class="label">ROOM TYPE</div>
            <div class="value">{{ $booking->room->category->category_name }}</div>
        </div>


        <div class="row">
            <div class="label">PRICE /night</div>
            <div class="value">
                IDR {{ number_format($booking->room->price, 0, ',', '.') }}
            </div>
        </div>
        <div class="row">
            <div class="label">CHECKIN DATE</div>
            <div class="value">
                {{ \Carbon\Carbon::parse($booking->checkin_date)->format('d M Y') }}
            </div>
        </div>

        <div class="row">
            <div class="label">CHECKOUT DATE</div>
            <div class="value">
                {{ \Carbon\Carbon::parse($booking->checkout_date)->format('d M Y') }}
            </div>
        </div>
        <div class="row">
            <div class="label">TOTAL NIGHTS</div>
            <div class="value">
                {{ \Carbon\Carbon::parse($booking->checkout_date)->diffInDays($booking->checkin_date) }}
                night(s)
            </div>
        </div>

        <div class="row">
            <div class="label">PAY METHOD</div>
            @if ($booking->payment_method == 1)
                <div class="value">Bank Transfer</div>
            @elseif ($booking->payment_method == 0)
                <div class="value">Credit Card</div>
            @elseif ($booking->payment_method == 2)
                <div class="value">e-Wallet</div>
            @endif
        </div>

        <div class="row">
            <div class="label">TIME PAY</div>
            <div class="value">
                {{ \Carbon\Carbon::parse($booking->updated_at)->format('d-m-Y, H.i.s') }}
            </div>
        </div>



        <a href="{{ route('history') }}">
            <button class="btn">Confirm</button>
        </a>
    </div>
</body>

</html>
