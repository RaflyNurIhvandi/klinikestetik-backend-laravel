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

<body>
    <center>
        <h4>Data Barang</h4>
    </center>
    <table>
        <tr>
            <th>No</th>
            <th>Batch Number</th>
            <th>Product Name</th>
            <th>Selling Price</th>
            <th>Stok</th>
        </tr>
        @foreach ($data as $b)
            <tr>
                <td>{{ $b->id }}</td>
                <td>{{ $b->kodeproduk }}</td>
                <td>{{ $b->namaproduk }}</td>
                <td>{{ $b->hargajual }}</td>
                <td>{{ $b->stokmin }}</td>
            </tr>
        @endforeach
    </table>
</body>
