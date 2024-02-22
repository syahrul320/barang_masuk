<!doctype html>
<html lang="en" class="light-theme">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/icon.png') }}">

    <meta name="turbolinks-cache-control" content="no-cache">
    <!-- loader-->
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">

    <!-- CSS Files -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12px;
            margin: 10px;
            width: 100%;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        h1 {
            color: #333;
        }

        .content {
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .signature {
            margin-top: 40px;
        }

        .signature p {
            text-align: right;
        }

        .date {
            margin-top: 10px;
            text-align: right;
        }

        .headerku {
            font-size: 14px;
            font-weight: bold;
        }

        table {
            width: 90%;
            border-collapse: collapse;
            margin: 0;
        }

        td {
            /* border: 1px solid; */
            padding: 2px;
            text-align: left;
            margin: 0;
        }

        .ali {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
    <title>Surat Pernyataan</title>
</head>

<body>

    <header>
        <span class="headerku">SURAT PERNYATAAN ORANG TUA/WALI SANTRI</span>
    </header>

    <div class="content">
        <span>Saya yang bertanda tangan di bawah ini:</span>
        <div class="ali">
            <table>
                <tr>
                    <td width="20%">Nama</td>
                    <td width="3%">:</td>
                    <td width="77%">{{ $user->nama_wali }}</td>
                </tr>
                <tr>
                    <td width="20%">Alamat</td>
                    <td width="3%">:</td>
                    <td width="77%">{{ $user->alamat }}</td>
                </tr>
                <tr>
                    <td width="20%">No. NIK KTP</td>
                    <td width="3%">:</td>
                    <td width="77%">{{ $user->nik_wali }}</td>
                </tr>
                <tr>
                    <td width="20%">Wali Santri dari</td>
                    <td width="3%">:</td>
                    <td width="77%">{{ $user->name }}</td>
                </tr>
                <tr>
                    <td width="20%">No. HP/WA</td>
                    <td width="3%">:</td>
                    <td width="77%">{{ $user->no_hp_wali }}</td>
                </tr>
            </table>
        </div>

        <header>
            <span class="headerku">MENYATAKAN</span>
        </header>

        <p>Bahwa Saya selaku Orang Tua / Wali Santri :
            <br>Dengan ini menyatakan, bahwa:
        </p>
    </div>

    <div class="ali">
        <table>
            <tr>
                <td width="5%">1.</td>
                <td width="95%">Bersedia menyerahkan anak saya sepenuhnya untuk dididik di Pondok Pesantren Salaf
                    Modern
                    Thohir Yasin, tanpa ada paksaan dari pihak manapun.
                </td>
            </tr>
            <tr>
                <td width="5%">2.</td>
                <td width="95%">Menerima dan bersedia menjalankan semua aturan lembaga di Pondok Pesantren.
                </td>
            </tr>
            <tr>
                <td width="5%">3.</td>
                <td width="95%">Sanggup menunaikan semua jenis pembayaran administrasi yang telah ditetapkan oleh
                    pengurus
                    lembaga dan Pondok Pesantren sampai selesai/tamat.
                </td>
            </tr>
            <tr>
                <td width="5%">4.</td>
                <td width="95%">Bersedia mengganti segala biaya yang timbul akibat dari kelalaian anak saya yang
                    merugikan
                    lembaga dan Pondok Pesantren.
                </td>
            </tr>
            <tr>
                <td width="5%">5.</td>
                <td width="95%">Biaya pendaftaran dan Daftar ulang dianggap hangus, jika mengundurkan diri.
                </td>
            </tr>
            <tr>
                <td width="5%">6.</td>
                <td width="95%">Bersedian menyelesaikan dengan musyawarah dan kekeluargaan terlebih dahulu apabila
                    ada
                    masalah antara santri/santriwati yang terjadi diluar kendali dan tanpa sepengetahuan pengurus
                    lembaga dan Pondok Pesantren, sebelum menyampaikan kepada pihak ketiga (polisi, TNI, Media)
                </td>
            </tr>
            <tr>
                <td width="5%">7.</td>
                <td width="95%">Tidak akan melakukan tindakan yang dapat mencemarkan nama baik lembaga dan Pondok
                    Pesantren melalui media elektronik, berupa tulisan, gambar, foto, video dan yang lainnya yang dapat
                    menimbulkan fitnah.
                </td>
            </tr>
            <tr>
                <td width="5%">8.</td>
                <td width="95%">Tidak akan melakukan tindak banding, maupun keberatan dalam bentuk tindakan hukum
                    pidana atau
                    perdata, jika pada kemudian hari akan terjadi hal-hal yang tidak dikehendaki, berkaitan dengan
                    sanksi-sanksi.
                </td>
            </tr>
            <tr>
                <td width="5%">9.</td>
                <td width="95%">Siap berkerjasama dengan pihak pesantren untuk keberhasilan santri, dan tidak
                    intervensi berlebihan
                    terhadap program lembaga dan pondok pesantren
                </td>
            </tr>
            <tr>
                <td width="5%">10.</td>
                <td width="95%">Saya bersedia dituntut balik apabila melanggar surat pernyataan ini.
                </td>
            </tr>
        </table>
    </div>
    <br>
    <div class="ali">
        <table>
            <tr>
                <td width="60%">&nbsp;</td>
                <td style="text-align: right" width="20%">Dibuat di</td>
                <td style="text-align: right" width="2%">:</td>
                <td width="23%">{{ $user->alamat }}</td>
            </tr>
            <tr>
                <td width="60%">&nbsp;</td>
                <td style="text-align: right" width="20%">Pada Tanggal</td>
                <td style="text-align: right" width="2%">:</td>
                <td width="23%">{{ $user->created_at }}</td>
            </tr>
            <tr>
                <td colspan="4">&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td colspan="3" style="text-align: center">Yang membuat pernyataan <br>
                    Orang Tua/Wali Santri
                </td>
            </tr>
            <tr>
                <td colspan="4" height="70px">&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td colspan="3" style="text-align: center"><u>({{ $user->nama_wali}})</u>
                </td>
            </tr>
        </table>
    </div>


    <!-- JS Files-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap5.min.js') }}"></script>

    <!-- Main JS-->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @stack('scripts')

    <script>
        window.print();
    </script>
</body>

</html>
