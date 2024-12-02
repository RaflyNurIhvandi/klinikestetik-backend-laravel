<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h3 {
            font-family: Arial;
        }

        table {
            font-family: arial;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            font-size: 13px
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>
    <center>
        <h3>Data Supplier</h3>
    </center>
    <table>
        <tr>
            <th>No</th>
            <th> Company Name</th>
            <th>Address</th>
            <th>City</th>
            <th>Contact Person</th>
        </tr>
        @foreach ($pemasok as $d)
            <tr>
                <td>{{ $d->id }}</td>
                <td>{{ $d->namapemasok }}</td>
                <td>{{ $d->alamatpemasok }}</td>
                <td>{{ $d->kotapemasok }}</td>
                <td>{{ $d->notelpkontak }}</td>
            </tr>
        @endforeach
    </table>
    <script>
        window.print();
    </script>
</body>
</html>