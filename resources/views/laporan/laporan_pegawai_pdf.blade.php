<!DOCTYPE html>
<html lang="">

    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
            integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="public/viho/assets/css/fontawesome.css">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
            integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"
            integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous">
        </script>
        <title>Data Laporan Cuti</title>
    </head>

    <body>
        <div class="text-center mb-5">
            <h3>REKAP LAPORAN CUTI SCOMPTEC</h3>
            <h3>{{$tanggal[0]}} s/d. {{$tanggal[1]}}</h3>
        </div>
        <div class="container-fluid">
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jenis Cuti</th>
                        <th>No Surat</th>
                        <th>Tanggal Surat</th>
                        <th>Tanggal Awal</th>
                        <th>Tanggal Akhir</th>
                        <th>Jumlah Cuti</th>
                    </tr>
                </thead>
                @forelse($laporan as $lp)
                <tr class="text-center">
                    <td>{{$loop->iteration}}</td>
                    <td>{{ $lp->pegawai->nama_pegawai }}</td>
                    <td>{{$lp->kategori_cuti}}</td>
                    <td>{{ $lp->no_surat }}</td>
                    <td>{{$lp->tgl_surat}}</td>
                    <td>{{$lp->tgl_awal_cuti}}</td>
                    <td>{{$lp->tgl_akhir_cuti}}</td>
                    <td>{{$lp->lama_cuti}} Hari</td>
                </tr>
                @empty
                <tr>
                    <td colspan="9">
                        <div class="text-center">
                            <h4>DATA TIDAK DITEMUKAN</h4>
                        </div>
                    </td>
                </tr>
                @endforelse
            </table>
        </div>
    </body>

</html>