<body>
    <div>
        <div class="container">
            <div class="row1">
                <div class="cola">
                    @foreach ($selectbarangs as $b)
                        <div class="namapemasok">{{ $b->terimadari }}</div>
                    @endforeach
                    @foreach ($datapemasok as $b)
                        <div class="alamatpemasok">{{ $b->alamatpemasok }}</div>
                        <div>{{ $b->kotapemasok }} Telp. {{ $b->notelppemasok }}</div>
                    @endforeach
                </div>
            </div>
            <div class="row2">
                <div class="colb">
                    @foreach ($selectbarangs as $b)
                        <div class="noref">No Referensi &nbsp;&nbsp;&nbsp;&nbsp;: {{ $b->referensi }}</div>
                        <div class="tgl">Tanggal Terima : {{ $b->tglterima }}</div>
                        <div class="keterangan">Keterangan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                            {{ $b->keterangan }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div><br><br><br><br><br><br><br><br>
    <div class="produks">
        <table>
            <thead>
                <tr>
                    <td>Kode Produk</td>
                    <td>Nama Barang</td>
                    <td>Harga</td>
                    <td>Jumlah</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($selectdetails as $d)
                    <tr>
                        <td>{{ $d->kodeproduk }}</td>
                        <td>{{ $d->namaproduk }}</td>
                        <td>{{ $d->harga }}</td>
                        <td>{{ $d->jumlah }}</td>
                        <td>{{ $d->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="ttd">
        <div class="ttd1">
            <div>
                Pengirim
            </div>
            <div>&nbsp;</div>
            <div>&nbsp;</div>
            <div>&nbsp;</div>
            <div>&nbsp;</div>
            <div>
                (...........................)
            </div>
        </div>
        <div class="ttd2">
            <div>
                Penerima
            </div>
            <div>&nbsp;</div>
            <div>&nbsp;</div>
            <div>&nbsp;</div>
            <div>&nbsp;</div>
            <div>
                (...........................)
            </div>
        </div>
    </div>
</body>
<style>
    .ttd2{
        float: right;
        margin-right: 150;
    }
    .ttd1{
        float: left;
        margin-left: 150;
    }
    .ttd{
        text-align: center;
        margin: 4%;
        margin-top: 130;
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

    .data {
        margin: 4%;
    }

    .produks {
        display: flex;
        float: unset;
        margin: 4%;
    }

    .tgl {
        margin-bottom: 27;
    }

    .noref {
        margin-top: 27;
        margin-bottom: 27;
    }

    .colb {
        text-align: start;
    }

    .alamatpemasok {
        margin-bottom: 5;
    }

    .namapemasok {
        font-size: 27;
        margin-bottom: 5;
    }

    .cola {
        text-align: start;
    }

    .container {
        text-align: center;
        margin: 4%;
    }

    .row1 {
        float: left;
    }

    .row2 {
        float: right;
    }

    .col {}
</style>
<script>
    window.print();
</script>
