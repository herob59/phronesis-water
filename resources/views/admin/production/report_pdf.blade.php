<!DOCTYPE html>
<html>
<head>
    <title>Production Report</title>

    <style>

        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #000;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        h2, h4 {
            text-align: center;
        }

    </style>
</head>
<body>

    <h2>Astomville Water Factory</h2>

    <h4>Production Report</h4>

    <p>
        Total Production:
        <strong>{{ $totalProduction }}</strong>
    </p>

    <table>

        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Date</th>
            </tr>
        </thead>

        <tbody>

            @foreach($productions as $production)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>
                    {{ $production->product->name ?? 'N/A' }}
                </td>

                <td>{{ $production->quantity }}</td>

                <td>
                    {{ $production->created_at->format('d M Y') }}
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</body>
</html>