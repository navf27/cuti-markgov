<!DOCTYPE html>
<html lang="">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
            integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
            integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"
            integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous">
        </script>
        <style>
            .text-start{
                font-size: 12px;
            }
            .text{
                font-size: 12px;
            }
        </style>
        <title>Data Pengajuan Cuti</title>
    </head>

    <body>
        <div class="text-wrap text-right">
            <img src="{{ public_path('LOGO_SCOMPTEC.png') }}" width="150px" height="30px" alt="logo">
        </div>
        <div class="text-center mb-1">
            <h4 class="mb-0 pb-0">SURAT PERMOHONAN CUTI</h4>
            <p>No: {{$pengajuan->no_surat ?? '-'}}</p>
        </div>
        <div class="container-fluid">
            <div class="text-start mb-3">Dengan Hormat</div>
            <table>
                <tr>
                    <td style="width: 25%">
                        <div class="text-start ml-5 mb-3">Nama</div>
                    </td>
                    <td>
                        <div class="text-start ml-5 mb-3">: {{$pengajuan->pegawai->nama_depan}} {{$pengajuan->pegawai->nama_belakang}}</div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%">
                        <div class="text-start ml-5 mb-3">Jabatan {{$pengajuan->pegawai->user->role_name}}</div>
                    </td>
                    <td>
                        <div class="text-start ml-5 mb-3">: {{$pengajuan->pegawai->user->role_name}}</div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%">
                        <div class="text-start ml-5 mb-3">Divisi</div>
                    </td>
                    <td>
                        <div class="text-start ml-5 mb-3">: {{$pengajuan->pegawai->divisi->nama_divisi}}</div>
                    </td>
                </tr>
            </table>

            <div class="text-start mb-3">Dengan ini mengajukan permohonan untuk mengambil cuti :</div>
            <table>
                <tr>
                    <td>
                        <div class="text-start ml-5 mb-3">Kategori Cuti</div>
                    </td>
                    <td>
                        <div class="text-start ml-5 mb-3">: {{$pengajuan->kategori_cuti}}</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="text-start ml-5 mb-3">Tanggal</div>
                    </td>
                    <td>
                        <div class="text-start ml-5 mb-3">: {{$pengajuan->tgl_awal_cuti}} s/d. {{$pengajuan->tgl_akhir_cuti}}</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="text-start ml-5 mb-3">Lama Cuti</div>
                    </td>
                    <td>
                        <div class="text-start ml-5 mb-3">: {{$pengajuan->lama_cuti}} hari</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="text-start ml-5 mb-3">Keterangan Cuti</div>
                    </td>
                    <td>
                        <div class="text-start ml-5 mb-3">: {{$pengajuan->keterangan}}</div>
                    </td>
                </tr>
            </table>

            <div class="text-start mb-3">Adapun Perincian Hak Cuti saya sampaikan dengan hari ini adalah sebagai berikut</div>
            <table>
                <tr>
                    <td>
                        <div class="text-start ml-5 mb-3">Hak Cuti Tahun Ini</div>
                    </td>
                    <td>
                        <div class="text-start ml-5 mb-3">: {{$pengajuan->sisa_cuti}}</div>
                    </td>
                    <td>
                        <div class="text-start ml-5 mb-3"> hari</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="text-start ml-5 mb-3">Sisa Cuti Tahun Lalu</div>
                    </td>
                    <td>
                        <div class="text-start ml-5 mb-3">: -</div>
                    </td>
                    <td>
                        <div class="text-start ml-5 mb-3"> hari</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="text-start ml-5 mb-3">Jumlah</div>
                    </td>
                    <td>
                        <div class="text-start ml-5 mb-3">: {{$pengajuan->sisa_cuti}}</div>
                    </td>
                    <td>
                        <div class="text-start ml-5 mb-3"> hari</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="text-start ml-5 mb-3">Sudah diambil</div>
                    </td>
                    <td>
                        <div class="text-start ml-5 mb-3">: {{$pengajuan->kategori == 1 || $pengajuan->kategori == null ? $pengajuan->lama_cuti : '-'}}</div>
                    </td>
                    <td>
                        <div class="text-start ml-5 mb-3"> hari</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="text-start ml-5 mb-3">Sisa Cuti</div>
                    </td>
                    <td>
                        <div class="text-start ml-5 mb-3">: {{$pengajuan->sisa_cuti_min}}</div>
                    </td>
                    <td>
                        <div class="text-start ml-5 mb-3"> hari</div>
                    </td>
                </tr>
            </table>

            <div class="text-start mb-3">Demikian permohonan saya, dan atas perhatian serta perkenannya saya mengucapkan terima kasih.</div>
            <div class="text-start">Surabaya, {{$pengajuan->tgl_dibuat}}</div>
            <div class="text-start">Hormat saya <br><img src="data:image/png;base64, {!! $pengajuan->qr_pengaju !!}"></div>

            <table style="width: 100%">
                    <tr>
                        <td>
                            <div class="text-start">{{$pengajuan->pegawai->nama_depan}} {{$pengajuan->pegawai->nama_belakang}}</div>
                            <div class="text-start">Mengetahui</div> 
                            @if ($pengajuan->status == '1')
                            <img src="data:image/png;base64, {!! $pengajuan->qr_direktur !!}">
                            <div class="text-start mb-3">{{$pengajuan->mengetahui}}</div>
                            @else
                            <br><br><br><br>
                            <div class="text-start mb-3">........................................................</div>
                            @endif
                        </td>
                        <td style="padding-left: 20%">
                            <div class="text-start"><br></div>
                            <div class="text-start">Menyetujui</div> 
                            @if ($pengajuan->acc_kepala == '1')
                            <img src="data:image/png;base64, {!! $pengajuan->qr_kepala !!}">
                            <div class="text-start mb-3">{{$pengajuan->menyetujui}}</div>
                            @else
                            <br><br><br><br>
                            <div class="text-start mb-3">........................................................</div>
                            @endif
                        </td>
                    </tr>
            </table>

            <div class="text-center mb-3">
                <div class="text"><b>Head Office</b> : Jl. Kayun 24 Surabaya 60271 - Indonesia, Phone (031)-5315678 (Hunting). Facs : (031)-5319806</div>
                <div class="text-center mb-3 text">Email address : sco@scomptec.co.id</div>
            </div>
        </div>
    </body>
</html>