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
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .nota {
            width: 95%;
            margin: 20px auto;
            /* border: 1px solid #ccc; */
            padding: 10px;
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
        }

        .header {
            /* text-align: center; */
            padding: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }

        th,
        td {
            /* border: 1px solid; */
            padding: 4px;
            text-align: left;
            margin: 0;
        }

        /* th {
            background-color: #f2f2f2;
        } */

        .borderheader {
            border: 1px solid;
            font-size: 10px;
        }

        .data {
            font-size: 10px;
        }

        .juduldata {
            font-size: 11px;
            font-weight: bold;
            background-color: #eaeaea;
        }

        .ket {
            width: 20%;
        }

        .titikkoma {
            width: 2%;
            text-align: right;

        }

        .isian {
            width: 20%;
        }

        .right-align {
            text-align: right;
        }

        .rupiah::before {
            content: "Rp ";
        }
    </style>
    <title>Data Peserta</title>
</head>

<body>

    <div class="nota">
        <table>
            <tr>
                <td rowspan="2">
                    <img src="{{ asset('assets/images/headernota.png') }}" width="100%" height="100px">
                </td>
                <td style="font-size: 11px">Tanggal : {{ $user->created_at }}</td>
            </tr>
            <tr>
                <td style="font-size: 11px">No. Pendaftaran : {{ $user->no_pendaftaran }}</td>
            </tr>
        </table>
        <table>
            <tbody class="data">
                <tr>
                    <td class="juduldata" colspan="5">PEMBUATAN AKUN</td>
                    <td rowspan="5">
                        <center><img src="{{ asset('assets/images/user.png') }}" width="100px" height="100px"></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">* Akun akan digunakan untuk login ke halaman dashboard anda selama proses PPSB
                        berlangsung</td>
                </tr>
                <tr>
                    <td class="ket">Email*</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="3">{{ $user->email }}</td>
                </tr>
                <tr>
                    <td class="ket">Password*</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="3">{{ $user->password }}</td>
                </tr>
                <tr>
                    <td class="ket">NIK*</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="3">{{ $user->nik }}</td>
                </tr>
                <tr>
                    <td class="ket">Jenis Pendaftaran*</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="4">{{ $user->jenis_pendaftaran }}</td>
                </tr>
                <tr>
                    <td colspan="6">Jenjang Pendidikan yang diambil *</td>
                </tr>
                <tr>
                    <td class="ket">Tinkat TK/RA</td>
                    <td class="titikkoma">:</td>
                    <td class="isian">{{ $user->tk_ra }}</td>
                    <td width="20%" class="right-align">Tinkat SD/MI</td>
                    <td width="2%" class="right-align">:</td>
                    <td width="15%">{{ $user->sd_mi }}</td>
                </tr>
                <tr>
                    <td class="ket">Tinkat SLTP</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="4">{{ $user->tingkat_sltp }}</td>
                </tr>
                <tr>
                    <td class="ket">Tinkat SLTA</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="4">{{ $user->tingkat_slta }}</td>
                </tr>
                <tr>
                    <td class="ket">Tinkat PT</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="4">{{ $user->pt }}</td>
                </tr>
                <tr>
                    <td class="ket">Boarding School*</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="4">{{ $user->boarding_school }}</td>
                </tr>
                <tr>
                    <td class="juduldata" colspan="6">A. DATA PENDAFTAR</td>
                </tr>
                <tr>
                    <td class="ket">Nama Lengkap*</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="4">{{ $user->name }}</td>
                </tr>
                <tr>
                    <td class="ket">Jenis Kelamin*</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="4">{{ $user->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <td class="ket">NISN*</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="4">{{ $user->nisn }}</td>
                </tr>
                <tr>
                    <td class="ket">Tempat Lahir*</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="4">{{ $user->tempat_lahir }}</td>
                </tr>
                <tr>
                    <td class="ket">Status dalam Kel.*</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="4">{{ $user->status_dalam_keluarga }}</td>
                </tr>
                <tr>
                    <td class="ket">Anak Urutan Ke*</td>
                    <td class="titikkoma">:</td>
                    <td class="isian">{{ $user->anak_urutan_ke }}</td>
                    <td width="20%" class="right-align">Jumlah Saudara</td>
                    <td width="2%" class="right-align">:</td>
                    <td width="15%">{{ $user->jumlah_saudara_lk }} Laki-Laki {{ $user->jumlah_saudara_pr }}
                        Perempuan</td>
                </tr>
                <tr>
                    <td class="ket">Berat Badan</td>
                    <td class="titikkoma">:</td>
                    <td class="isian">{{ $user->berat_badan }}</td>
                    <td width="20%" class="right-align">Tinggi Badan</td>
                    <td width="2%" class="right-align">:</td>
                    <td width="15%">{{ $user->tinggi_badan }}</td>
                </tr>
                <tr>
                    <td class="ket">Ukuran Baju</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="5">{{ $user->ukuran_baju }}</td>
                </tr>
                <tr>
                    <td class="ket">Riwayat Penyakit</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="5">{{ $user->riwayat_penyakit }}</td>
                </tr>
                <tr>
                    <td class="ket">Alamat Sesuai KK*</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="5">{{ $user->alamat }}</td>
                </tr>
                <tr>
                    <td class="ket">RT/RW</td>
                    <td class="titikkoma">:</td>
                    <td class="isian">{{ $user->rt_rw }}</td>
                    <td width="20%" class="right-align">Desa/Kel.*</td>
                    <td width="2%" class="right-align">:</td>
                    <td width="15%">{{ $user->desa }}</td>
                </tr>
                <tr>
                    <td class="ket">Kecamatan*</td>
                    <td class="titikkoma">:</td>
                    <td class="isian">{{ $user->kec }}</td>
                    <td width="20%" class="right-align">Kab.*</td>
                    <td width="2%" class="right-align">:</td>
                    <td width="15%">{{ $user->kab }}</td>
                </tr>
                <tr>
                    <td class="ket">Provinsi*</td>
                    <td class="titikkoma">:</td>
                    <td class="isian">{{ $user->prov }}</td>
                    <td width="20%" class="right-align">Kode Pos.*</td>
                    <td width="2%" class="right-align">:</td>
                    <td width="15%">{{ $user->kode_pos }}</td>
                </tr>
                <tr>
                    <td class="ket">Tinggal Pada*</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="5">{{ $user->tinggal_pada }}</td>
                </tr>
                <tr>
                    <td class="ket">Nomor Telp./HP*</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="5">{{ $user->no_tlp }}</td>
                </tr>
                <tr>
                    <td colspan="6">OPTIONAL</td>
                </tr>
                <tr>
                    <td class="ket">Nomor SKTM (Surat Keterangan Tidak Mampu)</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="5">{{ $user->no_kks }}</td>
                </tr>
                <tr>
                    <td class="ket">Nomor KIP (Kartu Indonesia Pintar)</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="5">{{ $user->no_kip }}</td>
                </tr>
                <tr>
                    <td class="ket">Nomor KIS (Kartu Indonesia Sehat)</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="5">{{ $user->no_kis }}</td>
                </tr>
                <tr>
                    <td class="ket">Bantuan/Beasiswa yang pernah diperoleh</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="5">{{ $user->beasiswa_yang_diperoleh }}</td>
                </tr>
                <tr>
                    <td class="juduldata" colspan="6">B. INFORMASI MADRASAH/SEKOLAH ASAL</td>
                </tr>
                <tr>
                    <td class="ket">NPSN Sekolah Asal*</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="5">{{ $user->npsn }}</td>
                </tr>
                <tr>
                    <td class="ket">NSM/NSS Sekolah Asal*</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="5">{{ $user->nsm_nss_sekolah_asal }}</td>
                </tr>
                <tr>
                    <td class="ket">Nama Sekolah Asal*</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="5">{{ $user->nama_sekolah_asal }}</td>
                </tr>
                <tr>
                    <td class="ket">Alamat Sekolah Asal*</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="5">{{ $user->alamat_sekolah_asal }}</td>
                </tr>
                <tr>
                    <td class="ket">Tahun Lulus*</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="5">{{ $user->tahun_lulus }}</td>
                </tr>
                <tr>
                    <td class="juduldata" colspan="6">C. DATA ORANGTUA</td>
                </tr>
                <tr>
                    <td class="ket">NIK Ayah*</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="5">{{ $user->nik_ayah }}</td>
                </tr>
                <tr>
                    <td class="ket">Nama Ayah*</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="5">{{ $user->nama_ayah }}</td>
                </tr>
                <tr>
                    <td class="ket">Pendidikan Ayah*</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="5">{{ $user->pendidikan_ayah }}</td>
                </tr>
                <tr>
                    <td class="ket">Pekerjaan Ayah*</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="5">{{ $user->pekerjaan_ayah }}</td>
                </tr>
                <tr>
                    <td class="ket">Nomor HP Ayah*</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="5">{{ $user->no_hp_ayah }}</td>
                </tr>
                <tr>
                    <td class="ket">Penghasilan Ayah*</td>
                    <td class="titikkoma">:</td>
                    <td class="isian rupiah" colspan="5">{{ number_format($user->penghasilan_ayah, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="ket">NIK Ibu*</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="5">{{ $user->nik_ibu }}</td>
                </tr>
                <tr>
                    <td class="ket">Nama Ibu*</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="5">{{ $user->nama_ibu }}</td>
                </tr>
                <tr>
                    <td class="ket">Pendidikan Ibu*</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="5">{{ $user->pendidikan_ibu }}</td>
                </tr>
                <tr>
                    <td class="ket">Pekerjaan Ibu*</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="5">{{ $user->pekerjaan_ibu }}</td>
                </tr>
                <tr>
                    <td class="ket">Nomor HP Ibu*</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="5">{{ $user->no_hp_ibu }}</td>
                </tr>
                <tr>
                    <td class="ket">Penghasilan Ibu*</td>
                    <td class="titikkoma">:</td>
                    <td class="isian rupiah" colspan="5">{{ number_format($user->penghasilan_ibu, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="juduldata" colspan="6">D. DATA WALI</td>
                </tr>
                <tr>
                    <td class="ket">NIK Wali</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="5">{{ $user->nik_wali }}</td>
                </tr>
                <tr>
                    <td class="ket">Nama Wali</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="5">{{ $user->nama_wali }}</td>
                </tr>
                <tr>
                    <td class="ket">Pendidikan Wali</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="5">{{ $user->pendidikan_wali }}</td>
                </tr>
                <tr>
                    <td class="ket">Pekerjaan Wali</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="5">{{ $user->pekerjaan_wali }}</td>
                </tr>
                <tr>
                    <td class="ket">Nomor HP Wali</td>
                    <td class="titikkoma">:</td>
                    <td class="isian" colspan="5">{{ $user->no_hp_wali }}</td>
                </tr>
                <tr>
                    <td class="ket">Penghasilan Wali</td>
                    <td class="titikkoma">:</td>
                    <td class="isian rupiah" colspan="5">{{ number_format($user->penghasilan_wali, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td colspan="4">Petugas Penerima :</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td colspan="4" height="50px"></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td colspan="4">{{ $panitia->name }}</td>
                </tr>
            </tbody>
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
