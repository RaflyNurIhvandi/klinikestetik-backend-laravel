<div>
    <div style="text-align: center">Data Dokter Terapis Asisten</div>
    <table id="customers">
        <thead>
            <tr>
                <td>No.</td>
                <td>Kode Pegawai</td>
                <td>Nama Pegawai</td>
                <td>Alamat</td>
                <td>Kota</td>
                <td>No Telp</td>
                {{-- <td>Kategori</td> --}}
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($cetak as $ctk2)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>
                        {{ $ctk2->kodepegawai }}
                    </td>
                    <td>
                        {{ $ctk2->namapegawai }}
                    </td>
                    <td>
                        {{ $ctk2->alamatpegawai }}
                    </td>
                    <td>
                        {{ $ctk2->kotapegawai }}
                    </td>
                    <td>
                        {{ $ctk2->notelppegawai }}
                    </td>
                    {{-- <td>
                        {{ $ctk2->kategoripegawai }}
                    </td> --}}
                </tr>
            @endforeach
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
