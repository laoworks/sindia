<!DOCTYPE html>
<html>

<head>
    <title>Laporan Absensi</title>
    <style>
        body {
            font-family: Arial;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
        }

        th {
            background: #f2f2f2;
        }
    </style>
</head>

<body>

    <h3>Laporan Absensi Guru</h3>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Guru</th>
                <th>Masuk</th>
                <th>Pulang</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($absensi as $item)
                <tr>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->user->name ?? '-' }}</td>
                    <td>{{ $item->waktu_masuk ?? '-' }}</td>
                    <td>{{ $item->waktu_pulang ?? '-' }}</td>
                    <td>{{ $item->status_masuk }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
