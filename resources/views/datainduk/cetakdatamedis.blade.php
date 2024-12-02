<div>
    <div style="text-align: center">Data Medis</div>
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
            <tr @foreach ($cetak as $ctk2)>
                <td>{{ $no++ }}</td>
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
