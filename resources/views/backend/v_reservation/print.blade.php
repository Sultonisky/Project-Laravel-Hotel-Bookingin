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
                    <td>Rp. {{ number_format($print->room->price, 0, ',', '.') }}</td>
                    <td>{{ $print->tanggal_checkin }}</td>
                    <td>{{ $print->tanggal_checkout }}</td>
                    <td>Rp. {{ number_format($print->total_payment, 0, ',', '.') }}</td>
                    {{-- <td>{{ $print->payment == 1 ? 'Cash' : 'Credit' }}</td> --}}
                    <td>
                        @if ($print->payment == 1)
                            Cash
                        @else
                            Credit
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
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



{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Report</title>
    <!-- Include Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <div class="container my-4">
        <h2 class="text-center">{{ $judul }}</h2>
        <p>Period: {{ $startDate }} to {{ $endDate }}</p>

        <!-- Alert jika tidak ada data -->
        @if (session('no_data'))
            <div class="alert alert-warning text-center" role="alert">
                <strong>{{ session('no_data') }}</strong>
            </div>
        @endif

        <!-- Tabel data -->
        @if (isset($prints) && $prints->isNotEmpty())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Guest Name</th>
                        <th>Room Name</th>
                        <th>Room Price</th>
                        <th>Check-in Date</th>
                        <th>Check-out Date</th>
                        <th>Payment Method</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prints as $print)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $print->guest->name }}</td>
                            <td>{{ $print->room->room_name }}</td>
                            <td>Rp. {{ number_format($print->room->price, 0, ',', '.') }}</td>
                            <td>{{ $print->tanggal_checkin }}</td>
                            <td>{{ $print->tanggal_checkout }}</td>
                            <td>
                                @if ($print->payment == 1)
                                    Cash
                                @else
                                    Credit
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-danger text-center" role="alert">
                <strong>No data found for the selected period.</strong>
            </div>
        @endif
    </div>

    <!-- Script untuk cetak otomatis -->
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html> --}}
