<!DOCTYPE html>
<html lang="">

    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
            integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
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
            {{-- <h3>BULAN {{$bulan}}</h3> --}}
        </div>
        <div class="container">
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Divisi</th>
                    <th>Jumlah Cuti</th>
                    <th>Kuota Cuti</th>
                </tr>
                @forelse($pegawai as $p)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{ $p->nama_depan }} {{ $p->nama_belakang }}</td>
                    <td>{{ $p->divisi->nama_divisi }}</td>
                    <td>{{ $p->cuti_pegawai ? $p->cuti_pegawai->count() : 0}}x</td>
                    <td>{{$p->jum_cuti}} Hari</td>
                </tr>
                @empty
                <tr>
                    <div class="text-center">
                        <h3>DATA TIDAK DITEMUKAN</h3>
                    </div>
                </tr>
                @endforelse
            </table>
        </div>
    </body>
</html>