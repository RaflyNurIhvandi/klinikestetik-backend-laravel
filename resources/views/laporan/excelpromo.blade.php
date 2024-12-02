<style>
    h4 {
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
<div>
    <center>
        <h4>Laporan Penjualan Promo</h4>
    </center>
    <table>
        <tr>
            <th>No</th>
            <th>Kode Produk</th>
            <th>Nama produk</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Tanggal Jual</th>
            <th>Nomor Faktur</th>
        </tr>
        @foreach ($data as $d)
            <tr>
                <td>{{ $d->id }}</td>
                <td>{{ $d->kodeproduk }}</td>
                <td>{{ $d->namaproduk }}</td>
                <td>{{ $d->hargajual }}</td>
                <td>{{ $d->stokmin }}</td>
                <td>{{ $d->tgljual }}</td>
                <td>{{ $d->nofaktur }}</td>
            </tr>
        @endforeach
    </table>
</div>
