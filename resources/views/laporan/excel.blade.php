<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <center>
        <h3>Data Laporan Medis</h3>
    </center>
    <table>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Selling Price</th>
            <th>Tanggal Jual</th>
            <th>No Faktur</th>
        </tr>
        @foreach ($data as $lp)
            <tr>
                <td>{{ $lp->id }}</td>
                <td>{{ $lp->namaproduk }}</td>
                <td>{{ $lp->hargajual }}</td>
                <td>{{ $lp->tgljual }}</td>
                <td>{{ $lp->nofaktur }}</td>
            </tr>
        @endforeach
    </table>
    <script>
        window.print();
    </script>
</body>

</html>
