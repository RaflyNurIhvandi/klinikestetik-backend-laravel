<div>
    <div style="text-align: center">Data Pelanggan</div>
    <table id="customers">
        <thead>
            <tr>
                <td>No.</td>
                <td>Kode Pelanggan</td>
                <td>Nama Pelanggan</td>
                <td>Alamat</td>
                <td>Kota</td>
                <td>No Telp</td>
                <td>Kategori</td>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            <tr @foreach ($cetak as $ctk2)>
                <td>{{ $no++ }}</td>
                    <td>
                        {{ $ctk2->kodepelanggan }}
                    </td>
                    <td>
                        {{ $ctk2->namapelanggan }}
                    </td>
                    <td>
                        {{ $ctk2->alamatpelanggan }}
                    </td>
                    <td>
                        {{ $ctk2->kotapelanggan }}
                    </td>
                    <td>
                        {{ $ctk2->notelppelanggan }}
                    </td>
                    <td>
                        {{ $ctk2->kategoripelanggan }}
                    </td>
                </tr> @endforeach
                </tbody>
    </table>
</div>
<script>
    window.print();
</script>
<style>
    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td,
    #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #customers tr:hover {
        background-color: #ddd;
    }

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
    }
</style>
