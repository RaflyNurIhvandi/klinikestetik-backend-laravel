<div class="container">
    <h1>Faktur Penjualan</h1>
    @foreach ($cetak as $ctk)
        <div class="flex-container">
            <div class="flex-item-left">
                <div>
                    <p>Kode : {{ $ctk->kodepelanggan }}</p>
                </div>
                <div>
                    <p>
                        {{ $ctk->namapelanggan }} <br> {{ $ctk->alamatpelanggan }}{{ $ctk->kotapelanggan }} <br>
                        {{ $ctk->notelppelanggan }}
                    </p>
                </div>
            </div>
            <div class="flex-item-right">
                <div class="paraf">
                    <div><span class="lbl"> No Faktur</span><span class="lbl">{{ $ctk->nofaktur }}</span></div>
                </div>
                <div class="paraf">
                    <div><span class="lbl"> Tanggal </span>{{ $ctk->tgljual }}</div>
                </div>
                <div class="paraf">
                    <div><span class="lbl"> Syarat Bayar </span>{{ $ctk->syaratbayar }}</div>
                </div>
                <div class="paraf">
                    <div><span class="lbl"> Tanggal Jatuh Tempo </span>{{ $ctk->tgljatuhtempo }}</div>
                </div>
                <div class="paraf">
                    <div><span class="lbl"> Keterangan Bayar </span>{{ $ctk->keteranganbayar }}</div>
                </div>
            </div>
        </div>
</div>
@endforeach

<div class="section2">
    <div>
        <table id="customers">
            <thead>
                <tr>
                    <td>No.</td>
                    <td>Kode Barang</td>
                    <td>Nama Barang</td>
                    <td>Harga</td>
                    <td>Jumlah</td>
                    <td>Diskon</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($cetak2 as $ctk2)
                    <tr>
                        @php
                            $total = $ctk2->harga * $ctk2->jumlah - $ctk2->diskon;
                        @endphp
                        <td>{{ $no++ }}</td>
                        <td>
                            {{ $ctk2->kodeproduk }}
                        </td>
                        <td>
                            {{ $ctk2->namaproduk }}
                        </td>
                        <td>
                            {{ $ctk2->harga }}
                        </td>
                        <td>
                            {{ $ctk2->jumlah }}
                        </td>
                        <td>
                            {{ $ctk2->diskon }}
                        </td>
                        <td>
                            {{ $total }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="container">
    @foreach ($cetak as $ctk)
        <div class="flex-container">
            <div class="flex-item-left">
                <div>
                    <p>Keterangan : {{ $ctk->keterangan }}</p>
                </div>
                <div>
                    <p>Terbilang :</p>
                    <p style="font-style: italic" id="demo"></p>
                </div>
            </div>
            <div class="flex-item-right">
                <div>
                    <div class="lbl2">
                        Diskon
                    </div>
                    <div class="lbl2" id='rp'>Rp.</div>
                    <div id="dskn2" class="lbl3"></div>
                </div>
                <div>
                    <div class="lbl2">
                        Voucher
                    </div>
                    <div class="lbl2" id='rp'>Rp.</div>
                    <div id="vcr2" class="lbl3"></div>
                </div>
                <div>
                    <div class="lbl2">
                        Total
                    </div>
                    <div class="lbl2" id='rp'>Rp.</div>
                    <div id="ttl2" class="lbl3"></div>
                </div>
                <div>
                    <div class="lbl2">
                        Total Pajak
                    </div>
                    <div class="lbl2" id='rp'>Rp.</div>
                    <div id="ttlpjk2" class="lbl3"></div>
                </div>
                <div>
                    <div class="lbl2">
                        Grand total
                    </div>
                    <div class="lbl2" id='rp'>Rp.</div>
                    <div id="gtottt" class="lbl3"></div>
                </div>
                <div>
                    <div class="lbl2">
                        Bayar
                    </div>
                    <div class="lbl2" id='rp'>Rp.</div>
                    <div id="byr2" class="lbl3"></div>
                </div>
                <div>
                    <div class="lbl2">
                        Kembali
                    </div>
                    <div class="lbl2" id='rp'>Rp.</div>
                    <div class="lbl3" id="kmbl2">
                    </div>
                </div>
            </div>
        </div>
        <div hidden>
            <label>
                {{-- <span>Keterangan <span class="required"></span></span> --}}
                <input type="text" value="{{ $ctk->keterangan }}" disabled />
                <input id="dskn1" type="text" value="{{ $ctk->diskon }}" disabled hidden />
                <input id="vcr1" type="text" value="{{ $ctk->voucher }}" disabled hidden />
                <input id="ttl1" type="text" value="{{ $ctk->total }}" disabled hidden />
                <input id="ttlpjk1" type="text" value="{{ $ctk->totalpajak }}" disabled hidden />
                <input id="bilang" type="text" value="{{ $ctk->grandtotal }}" disabled hidden />
                <input id="byr1" type="text" value="{{ $ctk->bayar }}" disabled hidden />
                <input id="kmbl1" type="text" value="{{ $ctk->kembali }}" disabled hidden />
            </label>
        </div>
</div>
@endforeach
</div>
<script>
    window.print();
</script>
<script></script>
<script>
    var dskn = document.getElementById('dskn1').value;
    var dsknn = convertToRupiah(dskn);
    document.getElementById('dskn2').innerHTML = dsknn;
    var vcr = document.getElementById('vcr1').value;
    var vcrr = convertToRupiah(vcr);
    document.getElementById('vcr2').innerHTML = vcrr;
    var ttl = document.getElementById('ttl1').value;
    var ttll = convertToRupiah(ttl);
    document.getElementById('ttl2').innerHTML = ttll;
    var ttlpjk = document.getElementById('ttlpjk1').value;
    var ttlpjkk = convertToRupiah(ttlpjk);
    document.getElementById('ttlpjk2').innerHTML = ttlpjkk;
    var gtot = document.getElementById('bilang').value;
    var gtott = convertToRupiah(gtot);
    document.getElementById('gtottt').innerHTML = gtott;
    var byr = document.getElementById('byr1').value;
    var byrr = convertToRupiah(byr);
    document.getElementById('byr2').innerHTML = byrr;
    var kmbl = document.getElementById('kmbl1').value;
    var kmbll = convertToRupiah(kmbl);
    document.getElementById('kmbl2').innerHTML = kmbll;

    function convertToRupiah(angka) {
        var rupiah = '';
        var angkarev = angka.toString().split('').reverse().join('');
        for (var i = 0; i < angkarev.length; i++)
            if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
        return rupiah.split('', rupiah.length - 1).reverse().join('');
    }
</script>
<script>
    const bl = document.getElementById('bilang').value;
    const tr = terbilang(bl);
    document.getElementById("demo").innerHTML = tr;

    function terbilang(bilangan) {

        bilangan = String(bilangan);
        let angka = new Array('0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');
        let kata = new Array('', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan');
        let tingkat = new Array('', 'Ribu', 'Juta', 'Milyar', 'Triliun');

        let panjang_bilangan = bilangan.length;
        let kalimat = subkalimat = kata1 = kata2 = kata3 = "";
        let i = j = 0;

        /* pengujian panjang bilangan */
        if (panjang_bilangan > 15) {
            kalimat = "Diluar Batas";
            return kalimat;
        }

        /* mengambil angka-angka yang ada dalam bilangan, dimasukkan ke dalam array */
        for (i = 1; i <= panjang_bilangan; i++) {
            angka[i] = bilangan.substr(-(i), 1);
        }

        i = 1;
        j = 0;
        kalimat = "";

        /* mulai proses iterasi terhadap array angka */
        while (i <= panjang_bilangan) {

            subkalimat = "";
            kata1 = "";
            kata2 = "";
            kata3 = "";

            /* untuk Ratusan */
            if (angka[i + 2] != "0") {
                if (angka[i + 2] == "1") {
                    kata1 = "Seratus";
                } else {
                    kata1 = kata[angka[i + 2]] + " Ratus";
                }
            }

            /* untuk Puluhan atau Belasan */
            if (angka[i + 1] != "0") {
                if (angka[i + 1] == "1") {
                    if (angka[i] == "0") {
                        kata2 = "Sepuluh";
                    } else if (angka[i] == "1") {
                        kata2 = "Sebelas";
                    } else {
                        kata2 = kata[angka[i]] + " Belas";
                    }
                } else {
                    kata2 = kata[angka[i + 1]] + " Puluh";
                }
            }

            /* untuk Satuan */
            if (angka[i] != "0") {
                if (angka[i + 1] != "1") {
                    kata3 = kata[angka[i]];
                }
            }

            /* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
            if ((angka[i] != "0") || (angka[i + 1] != "0") || (angka[i + 2] != "0")) {
                subkalimat = kata1 + " " + kata2 + " " + kata3 + " " + tingkat[j] + " ";
            }

            /* gabungkan variabe sub kalimat (untuk Satu blok 3 angka) ke variabel kalimat */
            kalimat = subkalimat + kalimat;
            i = i + 3;
            j = j + 1;

        }

        /* mengganti Satu Ribu jadi Seribu jika diperlukan */
        if ((angka[5] == "0") && (angka[6] == "0")) {
            kalimat = kalimat.replace("Satu Ribu", "Seribu");
        }

        return (kalimat.trim().replace(/\s{2,}/g, ' ')) + " Rupiah";
    }
</script>
<style>
    .container {
        margin-left: 20px;
    }

    .flex-container {
        display: flex;
        flex-direction: row;
        /* flex-wrap: wrap */
        /* font-size: 30px; */
        text-align: left;
        font: 13px Arial, Helvetica, sans-serif;
    }

    .flex-item-left {
        padding: 0px;
        flex: 50%;
    }
    #rp{
        text-align: right;
    }
    #kmbl2 {
        text-align: right;
    }

    #dskn2 {
        text-align: right;
    }

    #vcr2 {
        text-align: right;
    }

    #ttl2 {
        text-align: right;
    }

    #ttlpjk2 {
        text-align: right;
    }

    #gtottt {
        text-align: right;
    }

    #byr2 {
        text-align: right;
    }

    span.lbl {
        padding-bottom: 10px;
        display: inline-block;
        width: 50%;
    }

    div.lbl {
        padding-bottom: 10px;
        display: inline-block;
        width: 50%;
    }

    .lbl2 {
        display: inline-block;
        padding-bottom: 10px;
        width: 30%;

    }

    .lbl3 {
        display: inline-block;
        width: 80px;

    }


    .flex-item-right {
        padding: 10px;
        flex: 50%;
    }


    body {
        margin-right: 0%
    }


    .form-style-2 {
        max-width: 500px;
        padding: 20px 12px 10px 20px;
        font: 13px Arial, Helvetica, sans-serif;
    }

    .form-style-2-heading {
        font-weight: bold;
        font-style: italic;
        border-bottom: 2px solid #ffffff;
        margin-bottom: 20px;
        font-size: 15px;
        padding-bottom: 3px;
    }

    .form-style-2 label {
        display: block;
        margin: 0px 0px 15px 0px;
    }

    .form-style-2 label>span {
        width: 100px;
        font-weight: bold;
        float: left;
        padding-top: 8px;
        padding-right: 50px;
    }


    .form-style-2 .tel-number-field {
        width: 40px;
        text-align: right;
    }

    .form-style-2 input.input-field,
    .form-style-2 .select-field {
        width: 45%;
    }

    .form-style-2 input.input-field,
    .form-style-2 .tel-number-field,
    .form-style-2 .textarea-field,
    .form-style-2 .select-field {
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        border: 1px solid #ffffff;
        /* box-shadow: 1px 1px 4px #ffffff; */
        -moz-box-shadow: 1px 1px 4px #ffffff;
        -webkit-box-shadow: 1px 1px 4px #ffffff;
        /* border-radius: 3px; */
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        padding: 7px;
        /* outline: none; */
    }

    .form-style-2 .input-field:focus,
    .form-style-2 .tel-number-field:focus,
    .form-style-2 .textarea-field:focus,
    .form-style-2 .select-field:focus {
        border: 1px solid rgb(255, 255, 255);
    }

    .form-style-2 .textarea-field {
        height: 100px;
        width: 50%;
    }

    .form-style-2 input[type=submit],
    .form-style-2 input[type=button] {
        border: none;
        padding: 8px 15px 8px 15px;
        background: #FF8500;
        color: #ffffff;
        box-shadow: 1px 1px 4px #ffffff;
        -moz-box-shadow: 1px 1px 4px #ffffff;
        -webkit-box-shadow: 1px 1px 4px #ffffff;
        border-radius: 3px;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
    }

    .form-style-2 input[type=submit]:hover,
    .form-style-2 input[type=button]:hover {
        background: #EA7B00;
        color: #ffffff;
    }

    #customers {
        font: 13px Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 90%;
        margin-left: 12px
    }

    #customers td,
    #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        color: rgb(255, 255, 255);
    }
</style>
