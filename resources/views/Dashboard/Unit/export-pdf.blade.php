@php
$settings=App\Models\Setting::first();
$companyName = $settings->website_name ?? 'Company Name';
$companyAddress = $settings->address ?? 'Company Address';
$companyPhone = $settings->website_phone ?? 'Phone Number';
$companyEmail = $settings->website_email ?? 'Email';
$companyLogo = public_path($settings->logo ?? 'assets/dashboard/img/city-square.jpg');
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Export PDF</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color: #333;
            margin: 30px;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }

        .header .info {
            flex: 1;
            text-align: left;
        }

        .header .info h2 {
            margin: 0;
            font-size: 20px;
            color: #2c3e50;
        }

        .header .info p {
            margin: 2px 0;
            font-size: 12px;
            color: #555;
        }

        .header .logo {
            width: 100px;
            height: auto;
        }

        h1 {
            text-align: center;
            font-size: 18px;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th,
        td {
            border: 1px solid #bdc3c7;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #3498db;
            color: #fff;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }

        .no-data {
            text-align: center;
            font-style: italic;
            color: #888;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="info">
            <h2>{{ $companyName }}</h2>
            <p>{{ $companyAddress }}</p>
            <p>Phone: {{ $companyPhone }} | Email: {{ $companyEmail }}</p>
        </div>
        <div class="logo">
            <img src="{{ $companyLogo }}" alt="Company Logo">
        </div>
    </div>

    <h1>units Report</h1>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th scope="col">Name</th>
                <th scope="col"> Address</th>
                <th scope="col">Onr Name</th>

                <th scope="col"> Parking</th>

                <th scope="col"> # Units</th>
                <th scope="col"> # Users</th>
                <th scope="col"> # Vehicles</th>
                <th scope="col"> # Spots</th>
                <th scope="col"> # guests</th>
                <th scope="col">Max Units</th>
                <th scope="col">Max Users</th>
                <th scope="col">Max Vehicles</th>
                <th scope="col">Max Spots</th>
                <th scope="col">Max guests</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($units as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->address }}</td>

                <td>{{ $item->user->first_name . ' '.$item->user->second_name }}</td>
                <td>{{ $item->parking->name}}</td>
                <td>{{ $item->unit->count() }}</td>

                <td>
                    {{ $item->users->count()}}
                </td>
                <td>{{ $item->users->flatMap->vehicle->count() }}</td>

                <td>{{ $item->spot->count()}}</td>
                <td>{{ $item->users->flatMap->guests->count() }}</td>

                <td>{{ $item->max_units }}</td>
                <td>{{ $item->max_users }}</td>
                <td>{{ $item->max_vehicles }}</td>
                <td>{{ $item->max_spots }}</td>
                <td>{{ $item->max_guests }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="16" class="no-data">No data available</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        &copy; {{ date('Y') }} {{ $companyName }}. All rights reserved.
    </div>

</body>

</html>
