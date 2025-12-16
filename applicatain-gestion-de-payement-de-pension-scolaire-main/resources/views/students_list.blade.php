<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List - {{ $classe->nom }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center; /* Centrer l'en-tête "N°" */
        }
        td:first-child {
            text-align: center; /* Centrer le numéro de l'élève */
        }
        .profile-img {
            width: 30px;
            height: 30px;
            object-fit: cover;
            border-radius: 50%;
            margin-right: 5px;
            vertical-align: middle;
        }
        .payment-status {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Student List - Class {{ $classe->nom }}</h2>

    <table>
        <thead>
            <tr>
                <th>N°</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Date of Birth</th>
                <th>Place of Birth</th>
                {{-- <th>Parent Email</th> --}}
                {{-- <th>Password</th> --}}
                <th>Payment</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($eleves as $index => $eleve)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $eleve->name }}</td>
                    <td>{{ $eleve->lastname }}</td>
                    <td>{{ $eleve->date_of_birth }}</td>
                    <td>{{ $eleve->place_of_birth }}</td>
                    
                    {{-- <td>{{ $eleve->initial_password }}</td> --}}
                    <td class="payment-status">
                        @if ($eleve->paid)
                            Yes
                        @else
                            No
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p>Generated on {{ now()->format('m/d/Y at H:i:s') }}</p>
</body>
</html>