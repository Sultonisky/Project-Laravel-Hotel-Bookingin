<!DOCTYPE html>
<html>

<head>
    <title>{{ $judul }}</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #ccc;
            font-family: Arial, sans-serif;
        }

        table tr td,
        table th {
            padding: 8px;
            text-align: left;
            font-size: 12px;
            border: 1px solid #ccc;
        }

        table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        body {
            margin: 20px;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <h3>{{ $judul }}</h3>
    <h4>Hotel Bookingin</h4>
    <p> Periode: {{ $startDate }} - {{ $endDate }}</p>

    <table>
        @if (isset($prints) && $prints->isNotEmpty())
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Guest Name</th>
                    <th>Room Name</th>
                    <th>Room Price</th>
                    <th>Check-in Date</th>
                    <th>Check-out Date</th>
                    <th>Total Payment</th>
                    <th>Payment Method</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($prints as $print)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $print->guest->name }}</td>
                        <td>{{ $print->room->room_name }}</td>
                        <td>IDR. {{ number_format($print->room->price, 0, ',', '.') }}</td>
                        <td>{{ $print->checkin_date }}</td>
                        <td>{{ $print->checkout_date }}</td>
                        <td>IDR. {{ number_format($print->total_payment, 0, ',', '.') }}</td>
                        <td>
                            @if ($print->payment_method == 1)
                                Cash
                            @else
                                Credit
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        @else
            <tbody>
                <tr>
                    <td colspan="8" style="text-align: center;">No reservation data found for the selected dates.
                        PLease select again.</td>
                </tr>
            </tbody>
        @endif
    </table>

    <script>
        window.onload = function() {
            printStruk();
        }

        function printStruk() {
            window.print();
            window.onafterprint = function() {
                window.close(); // Tutup tab setelah cetak selesai
            }
        }
    </script>
</body>

</html>
