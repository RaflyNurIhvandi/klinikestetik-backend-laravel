<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h3 {
            font-family: JuanMikes;
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
    </style>
</head>

<body>
    <center>
        <div style="text-align: center">Data Medis</div>
    </center>
    <table id="customers">
        <thead>
            <tr>
                <td>No.</td>
                <td>Kode Produks</td>
                <td>Nama Produks</td>
                <td>Harga Jual</td>
                <td>Deskripsi</td>
                {{-- <td>No Telp</td> --}}
                {{-- <td>Kategori</td> --}}
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($cetak as $ctk2)
                <tr>
                    <td>
                        {{ $no++ }}
                    </td>
                    <td>
                        {{ $ctk2->kodeproduk }}
                    </td>
                    <td>
                        {{ $ctk2->namaproduk }}
                    </td>
                    <td>
                        {{ $ctk2->hargajual }}
                    </td>
                    <td>
                        {{ $ctk2->deskripsi }}
                    </td>
                    {{-- <td>
                        {{ $ctk2->notelppegawai }}
                    </td> --}}
                    {{-- <td>
                        {{ $ctk2->kategoripegawai }}
                    </td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
