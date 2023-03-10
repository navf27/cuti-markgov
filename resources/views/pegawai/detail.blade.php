@extends('layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Detail Pegawai</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>Nama Depan: </b>{{ $pegawai->nama_depan }}</li>
                            <li class="list-group-item"><b>Nama Belakang: </b>{{ $pegawai->nama_belakang }}</li>
                            <li class="list-group-item"><b>Divisi: </b>{{ $pegawai->divisi->nama_divisi }}</li>
                            <li class="list-group-item"><b>Email: </b>{{ $pegawai->user->email }}</li>
                            <li class="list-group-item"><b>Nama Lengkap: </b>{{ $pegawai->nama_depan }} {{ $pegawai->nama_belakang }}</li>
                            <li class="list-group-item"><b>Role: </b>
                                @if ($pegawai->user->role == '1')
                                    Admin
                                @elseif ($pegawai->user->role == '2')
                                    Kepala
                                @else
                                    Pegawai
                                @endif
                            </li>
                            <li class="list-group-item"><b>Tanggal Lahir: </b>{{ $pegawai->tgl_lahir }}</li>
                            <li class="list-group-item"><b>No Hp: </b>{{ $pegawai->no_hp }}</li>
                            <li class="list-group-item"><b>Jenis Kelamin: </b>{{ $pegawai->jenis_kelamin }}</li>
                            <li class="list-group-item"><b>Alamat: </b>{{ $pegawai->alamat }}</li>
                            <li class="list-group-item"><b>Provinsi: </b>{{ $pegawai->province ? $pegawai->province->name : '-' }}</li>
                            <li class="list-group-item"><b>Kota: </b>{{ $pegawai->regency ? $pegawai->regency->name : '-' }}</li>
                            <li class="list-group-item"><b>Kecamatan: </b>{{ $pegawai->district ? $pegawai->district->name : '-' }}</li>
                            <li class="list-group-item"><b>Desa: </b>{{ $pegawai->village ? $pegawai->village->name : '-' }}</li>
                            <li class="list-group-item"><b>Jumlah Cuti: </b>{{ $pegawai->jum_cuti }}</li>
                        </ul>
                    </div>
                    <br>
                    @if (Auth::user()->role == '1')
                    <a class="btn btn-success mt-3" href="/pegawai">Kembali</a>
                    @else
                    <a class="btn btn-success mt-3" href="/pegawai_kepala">Kembali</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
